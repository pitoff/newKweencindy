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
