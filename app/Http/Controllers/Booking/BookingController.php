<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        if(!auth()->user()->is_admin){
            return view('bookings.users.index');
        }
        return view('bookings.admin.index');
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
        if($request->location === 'personal'){
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
                'book_date' => 'required|date|after:today'
            ]);
        }

        $createBooking = auth()->user()->booking()->create([
            'category_id' => $request->category,
            'location' => $request->location ?? '',
            'state' => $request->state ?? '',
            'town' => $request->town ?? '',
            'address' => $request->address ?? '',
            'payment_status' => false,
            'book_status' => false,
            'book_date' => $request->book_date
        ]);
        if($createBooking){
            dd('good');
        }
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

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
