<?php

namespace App\Http\Controllers\Booking;

use App\Enums\BookingStatusEnum;
use App\Events\BookingAccepted;
use App\Events\BookingDeclined;
use App\Events\MakeupBooked;
use App\Events\MakeupBookedAdmin;
use App\Events\PaymentMaid;
use App\Events\PaymentNotReceived;
use App\Events\PaymentReceived;
use App\Http\Controllers\Controller;
use App\Mail\BookingSuccessfull;
use App\Models\Booking;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    //add time when booking
    use ResponseTrait;

    public function index()
    {
        return view('bookings.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('bookings.create', [
            'categories' => $categories
        ]);
    }

    public function store(Booking $booking, Request $request)
    {
        if ($request->location == 'personal location') {
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'state' => 'required',
                'town' => 'required',
                'address' => 'required',
                'book_date' => 'required|date|after:today',
                'book_time' => 'required'
            ]);
        } else {
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'book_date' => 'required|date|after:today',
                'book_time' => 'required'
            ]);
        }

        try {
            // dd($request->all());
            $checkConfirmedBooking = Booking::where('book_status', BookingStatusEnum::BookingAccepted)
                ->where('payment_status', BookingStatusEnum::PaymentConfirmed)
                ->where('book_date', $request->book_date)
                ->where('book_time', $request->book_time)
                ->first();
            
            if($checkConfirmedBooking){
                return back()->with('err', 'Whoops!... Date already booked, Please choose a new date');
            }

            $createBooking = auth()->user()->booking()->create([
                'ref_no' => 'BBKC-' . Str::random(8),
                'category_id' => $request->category,
                'location' => $request->location,
                'state' => $request->state ?? '',
                'town' => $request->town ?? '',
                'address' => $request->address ?? '',
                'payment_status' => BookingStatusEnum::PendingPayment,
                'book_status' => BookingStatusEnum::PendingBooking,
                'book_date' => $request->book_date,
                'book_time' => $request->book_time
            ]);
            $user = User::where('id', $createBooking->user_id)->first(['fullname', 'email']);
            if ($createBooking) {
                MakeupBooked::dispatch(
                    $user->email,
                    $user->fullname,
                    $request->category,
                    $request->location,
                    $request->state,
                    $request->town,
                    $request->address,
                    $request->book_date,
                    $request->book_time
                );
                MakeupBookedAdmin::dispatch(
                    $user->fullname,
                    $request->category,
                    $request->location,
                    $request->state,
                    $request->town,
                    $request->address,
                    $request->book_date,
                    $request->book_time
                );
                return redirect(route('my_booking', auth()->user()->id))->with('success', 'You have successfully booked a date');
            }
        } catch (\Throwable $th) {
            // throw $th;
            dd($th->getMessage());
            // return back()->with('err', 'An error occured while processing booking');
        }
    }

    //get all bookings a user has made
    public function myBooking()
    {
        $data['booked'] = auth()->user()->booking()->orderBy('id', 'DESC')->paginate(15);
        $data['pendingBooking'] = BookingStatusEnum::PendingBooking;
        $data['bookingDeclined'] = BookingStatusEnum::BookingDeclined;
        $data['bookingAccepted'] = BookingStatusEnum::BookingAccepted;
        $data['awaitingConfirmation'] = BookingStatusEnum::AwaitingConfirmation;
        $data['payConfirmed'] = BookingStatusEnum::PaymentConfirmed;

        if (admin()) {
            return view('admin.bookings.mybooking', $data);
        } else {
            return view('bookings.mybooking', $data);
        }
    }

    //get all bookings for admin and all booking that has payment status of confirmed for users
    public function alreadyBooked(Booking $booked)
    {
        $data['payConfirmed'] = BookingStatusEnum::PaymentConfirmed;
        $data['payNotConfirmed'] = BookingStatusEnum::PaymentNotConfirmed;
        $data['pendingBooking'] = BookingStatusEnum::PendingBooking;
        $data['declinedBooking'] = BookingStatusEnum::BookingDeclined;
        $data['acceptedBooking'] = BookingStatusEnum::BookingAccepted;
        $data['awaitingConfirmation'] = BookingStatusEnum::AwaitingConfirmation;

        if (admin()) {
            $data['bookings'] = $booked->with(['user', 'category'])->orderBy('id', 'DESC')->paginate(15);
            return view('admin.bookings.all_booking', $data);
        } else {
            $data['bookings'] = $booked->where('payment_status', $data['payConfirmed']->value)->with(['category'])->orderBy('id', 'DESC')->paginate(15);
            return view('bookings.all_booking', $data);
        }
    }

    //get booking category
    public function categoryDetails($id)
    {
        $categoryDetails = Category::where('id', $id)->first();
        if (!$categoryDetails) {
            return $this->failure('category was not found');
        }
        return $this->success('retrieved categories', 200, $categoryDetails);
    }

    public function edit(Booking $booking, $id)
    {
        $categories = Category::all();
        $book = $booking->find($id);
        return view('bookings.edit', [
            'categories' => $categories,
            'book' => $book
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Booking::find($id);
        $formattedBookDate = date('Y-m-d', strtotime($book->book_date));
        // dd($formattedBookDate);
        if ($request->location == 'personal location') {
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'state' => 'required',
                'town' => 'required',
                'address' => 'required',
                'book_date' => '' ?? $formattedBookDate,
                'book_time' => '' ?? $book->book_time
            ]);

            $updateBooked = Booking::where('id', $id)->update([
                'category_id' => $request->category,
                'location' => $request->location,
                'state' => $request->state,
                'town' => $request->town,
                'address' => $request->address,
                'book_date' => $request->book_date ?? $formattedBookDate,
                'book_time' => $request->book_time ?? $book->book_time,
            ]);
        } else {
            $request->validate([
                'category' => 'required',
                'book_date' => '' ?? $formattedBookDate,
                'book_time' => '' ?? $book->book_time
            ]);

            $updateBooked = Booking::where('id', $id)->update([
                'category_id' => $request->category,
                'location' => $request->location,
                'state' => null,
                'town' => null,
                'address' => null,
                'book_date' => $request->book_date ?? $formattedBookDate,
                'book_time' => $request->book_time ?? $book->book_time,
            ]);
        }

        if ($updateBooked) {
            if (!admin()) {
                return redirect(route('my_booking', $book->id))->with('success', 'You have Updated your booking');
            }
            return redirect(route('already_booked'))->with('success', 'You just updated booking');
        }
    }

    public function delete($id)
    {
        $book = Booking::find($id);
        $deleted = $book->delete();
        if (!$deleted) {
            return $this->failure('Booking was deleted successfully', 404);
        }
        return $this->success('Booking appointment could not be deleted', 200);
    }

    private function userEmail($id)
    {
        $user = Booking::with('user')->where('bookings.id', $id)->first();
        $email = $user->user->email;
        return $email;
    }

    //admin accepts booking
    public function accept($id)
    {
        $acceptBooking = Booking::where('id', $id)->update([
            'book_status' => BookingStatusEnum::BookingAccepted
        ]);
        if ($acceptBooking) {
            //trigger booking accepted event
            BookingAccepted::dispatch($this->userEmail($id));
            return $this->success('Booking has been accepted', 200);
        } else {
            return $this->failure('Booking could not be accepted');
        }
    }

    //admin declines booking
    public function decline($id)
    {
        $declineBooking = Booking::where('id', $id)->update([
            'book_status' => BookingStatusEnum::BookingDeclined
        ]);
        if ($declineBooking) {
            //trigger booking declined event
            BookingDeclined::dispatch($this->userEmail($id));
            return $this->success('Booking has been declined', 200);
        } else {
            return $this->failure('Booking could not be declined at the moment');
        }
    }

    //user mark booking as paid
    public function markPaid($id)
    {
        $book = Booking::find($id);
        //trigger marked as paid event
        PaymentMaid::dispatch($this->userEmail($id));
        $mark = $book->update([
            'payment_status' => BookingStatusEnum::AwaitingConfirmation
        ]);
        if (!$mark) {
            return $this->failure('Booking appointment could not be marked as paid');
        }
        return $this->success('Booking was successfully marked as paid', 200);
    }

    //admin mark booking as payment received
    public function markReceived($id)
    {
        $book = Booking::find($id);
        //trigger payment received event
        PaymentReceived::dispatch($this->userEmail($id));
        $data['acceptedBooking'] = BookingStatusEnum::BookingAccepted;
        $checkAccepted = $book->book_status == $data['acceptedBooking']->value;
        if (!$checkAccepted) {
            return $this->failure('Please you need to accept the booking before you can mark as received', 400);
        }else{
            $book->update([
                'payment_status' => BookingStatusEnum::PaymentConfirmed,
    
            ]);
            return $this->success('You marked payment as received', 200);
        }
        
    }

    //admin mark booking as payment not received
    public function markNotReceived($id)
    {
        $book = Booking::find($id);
        //trigger mark not received event
        PaymentNotReceived::dispatch($this->userEmail($id));
        $book->update([
            'payment_status' => BookingStatusEnum::PaymentNotConfirmed
        ]);
        return $this->success('You marked payment as not received', 200);
    }

    public function previewBooking($id)
    {
        $booking = Booking::with('category', 'user')->where('id', $id)->first();
        if ($booking) {
            return $this->success('Booking retrieved', 200, $booking);
        }
    }

    public function priceTags()
    {
        $categories = Category::all();
        return view('bookings.price_tags', compact('categories'));
    }
}
