<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //list of users, view remove and apply discount

    public function index(User $user)
    {
        $users = $user->paginate(5);
        return view('users.index', compact('users'));
    }

    public function userBookings(Booking $bookings, $userId)
    {
        $userBookings = $bookings->with('user', 'category')->where('user_id', $userId)->paginate(5);
        $user = User::where('id', $userId)->value('fullname');
        // dd($user);
        return view('admin.discount.user_bookings', compact('userBookings', 'user'));
    }

    public function applyDiscount()
    {

    }
}
