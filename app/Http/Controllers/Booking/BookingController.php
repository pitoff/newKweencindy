<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
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

    public function store(Request $request)
    {
        if($request->location === 'personal location'){
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'state' => 'required',
                'town' => 'required',
                'address' => 'required',
                'book_date' => 'required|date|after:today'
            ]);
        }else{
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'book_date' => 'required|date|after:today'
            ]);
        }

        $createBooking = auth()->user()->booking()->create([
            'category_id' => $request->category,
            'location' => $request->location,
            'state' => $request->state ?? '',
            'town' => $request->town ?? '',
            'address' => $request->address ?? '',
            'payment_status' => false,
            'book_status' => false,
            'book_date' => $request->book_date
        ]);
        if(!$createBooking){
            return back()->with('error', 'An error occured while processing booking');
        }
        return redirect(route('my_booking', auth()->user()->id))->with('success', 'You have successfully booked a date');
    }

    public function myBooking()
    {
        $booked = auth()->user()->booking()->orderBy('created_at', 'DESC')->get();
        return view('bookings.mybooking', [
            'booked' => $booked
        ]);
    }

    public function categoryDetails($id)
    {
        $categoryDetails = Category::where('id', $id)->first();
        if(!$categoryDetails){
            return response()->json([
                'error' => 'category was not found'
            ]);
        }
        return response()->json([
            'data' => $categoryDetails
        ]);
    }

    public function show()
    {

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

        if($request->location === 'personal location'){
            $request->validate([
                'category' => 'required',
                'location' => 'required',
                'state' => 'required',
                'town' => 'required',
                'address' => 'required',
                'book_date' => '' ?? $book->book_date
            ]);
        }else{
            $request->validate([
                'category' => 'required',
                'book_date' => '' ?? $book->book_date
            ]);
        }

        $updateBooked = Booking::where('id', $id)->update([
            'category_id' => $request->category,
            'location' => $request->location ?? $book->location,
            'state' => $request->state ?? '',
            'town' => $request->town ?? '',
            'address' => $request->address ?? '',
            'payment_status' => false,
            'book_status' => false,
            'book_date' => $request->book_date ?? $book->book_date
        ]);

        if($updateBooked){
            if(!auth()->user()->is_admin){
                return redirect(route('my_booking', $book->id))->with('success', 'You have Updated your booking');
            }
            return redirect(route('already_booked'))->with('success', 'You just updated booking');
        }
    }

    public function delete($id)
    {
        $book = Booking::find($id);
        $deleted = $book->delete();
        if(!$deleted){
            return response()->json([
                'message' => 'Booking appointment could not be deleted'
            ]);
        }
        return response()->json([
            'message' => 'Booking was deleted successfully'
        ]);
    }

    public function accept($id)
    {
        $acceptBooking = Booking::where('id', $id)->update([
            'book_status' => 1
        ]);
        if(!$acceptBooking){
            return response()->json([
                'message' => 'Booking has been accepted'
            ]);
        }
        return response()->json([
            'message' => 'Booking could not be accepted'
        ]);
    }

    public function decline($id)
    {
        $declineBooking = Booking::where('id', $id)->update([
            'book_status' => 0
        ]);
        if(!$declineBooking){
            return response()->json([
                'message' => 'Booking has been declined'
            ]);
        }
        return response()->json([
            'message' => 'Booking could not be declined at the moment'
        ]);
    }

    public function alreadyBooked(Booking $booked)
    {
        $booking = $booked->orderBy('created_at', 'DESC')->get();
        return view('bookings.all_booking', [
            'bookings' => $booking
        ]);
    }

    public function markPaid($id)
    {
        $book = Booking::find($id);
        $book->update([
            'payment_status' => 1
        ]);
        return back();
    }

    public function markReceived($id)
    {
        $book = Booking::find($id);
        $book->update([
            'payment_status' => 2
        ]);
        return back();
    }

    public function previewBooking($id)
    {
        $booking = Booking::with('category', 'user')->where('id',$id)->first();
        if($booking){
            return response()->json([
                'data' => $booking
            ]);
        }
    }

}
