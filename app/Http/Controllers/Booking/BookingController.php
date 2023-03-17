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

class BookingController extends Controller
{
    use ResponseTrait;
    /*
        initial payment status = 0
        when user marks booking as paid, payment_status = 1
        when admin marks booking as received payment_status = 2
        when admin marks booking as not received payment_status = 0
        when admin accepts booking, booking_status = 1
        when admin decline booking, booking_status = 2

    */
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
                'book_date' => 'required|date|after:today'
            ]);
        } else {
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'book_date' => 'required|date|after:today'
            ]);
        }

        try {
            $createBooking = auth()->user()->booking()->create([
                'category_id' => $request->category,
                'location' => $request->location,
                'state' => $request->state ?? '',
                'town' => $request->town ?? '',
                'address' => $request->address ?? '',
                'payment_status' => BookingStatusEnum::PendingPayment,
                'book_status' => BookingStatusEnum::PendingBooking,
                'book_date' => $request->book_date
            ]);
            $user = User::where('id', $createBooking->user_id)->first(['name', 'email']);
            if ($createBooking) {
                MakeupBooked::dispatch(
                    $user->email,
                    $user->name,
                    $request->category,
                    $request->location,
                    $request->state,
                    $request->town,
                    $request->address,
                    $request->book_date
                );
                MakeupBookedAdmin::dispatch(
                    $user->name,
                    $request->category,
                    $request->location,
                    $request->state,
                    $request->town,
                    $request->address,
                    $request->book_date
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
            $data['bookings'] = $booked->with(['category'])->orderBy('id', 'DESC')->paginate(15);
            dd($data['bookings']);
            return view('bookings.all_booking', $data);
        }
    }

    //get booking category
    public function categoryDetails($id)
    {
        $categoryDetails = Category::where('id', $id)->first();
        if (!$categoryDetails) {
            return response()->json([
                'error' => 'category was not found'
            ]);
        }
        return response()->json([
            'data' => $categoryDetails
        ]);
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

        if ($request->location == 'personal location') {
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'state' => 'required',
                'town' => 'required',
                'address' => 'required',
                'book_date' => '' ?? $book->book_date
            ]);

            $updateBooked = Booking::where('id', $id)->update([
                'category_id' => $request->category,
                'location' => $request->location,
                'state' => $request->state,
                'town' => $request->town,
                'address' => $request->address,
                'book_date' => $request->book_date ?? $book->book_date
            ]);
        } else {
            $request->validate([
                'category' => 'required',
                'book_date' => '' ?? $book->book_date
            ]);

            $updateBooked = Booking::where('id', $id)->update([
                'category_id' => $request->category,
                'location' => $request->location,
                'state' => null,
                'town' => null,
                'address' => null,
                'book_date' => $request->book_date ?? $book->book_date
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
            return response()->json([
                'message' => 'Booking appointment could not be deleted'
            ]);
        }
        return response()->json([
            'message' => 'Booking was deleted successfully'
        ]);
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
        }else{
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
        }else{
            return $this->failure('Booking could not be declined at the moment');
        }
        
    }

    //mark booking as paid
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

    //mark booking as payment received
    public function markReceived($id)
    {
        $book = Booking::find($id);
        //trigger payment received received event
        PaymentReceived::dispatch($this->userEmail($id));
        $data['acceptedBooking'] = BookingStatusEnum::BookingAccepted;
        $checkAccepted = $book->book_status == $data['acceptedBooking']->value;
        if (!$checkAccepted) {
            return back()->with('err', 'Please you need to accept the booking before you can mark as received');
        }
        $book->update([
            'payment_status' => BookingStatusEnum::PaymentConfirmed,

        ]);
        return back()->with('success', 'You marked payment as received');
    }

    //mark booking as payment not received
    public function markNotReceived($id)
    {
        $book = Booking::find($id);
        //trigger mark not received event
        PaymentNotReceived::dispatch($this->userEmail($id));
        $book->update([
            'payment_status' => BookingStatusEnum::PaymentNotConfirmed
        ]);
        return back()->with('success', 'You marked payment as not received');
    }

    public function previewBooking($id)
    {
        $booking = Booking::with('category', 'user')->where('id', $id)->first();
        if ($booking) {
            return $this->success('Booking retrieved', 200, $booking);
        }
    }
}
