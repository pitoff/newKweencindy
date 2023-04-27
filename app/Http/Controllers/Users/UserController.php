<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyDiscountRequest;
use App\Models\Booking;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;
    //list users, view remove and apply discount

    public function index(User $user)
    {
        $users = $user->paginate(5);
        return view('users.index', compact('users'));
    }

    public function userBookings(Booking $bookings, $userId)
    {
        $userBookings = $bookings->with('user', 'category', 'discount')
            ->where('user_id', $userId)
            // ->where('book_status', )
            // ->where('payment_status', )
            ->paginate(5);
        $user = User::where('id', $userId)->value('fullname');
        return view('admin.discount.user_bookings', compact('userBookings', 'user'));
    }

    public function createDiscount(Booking $booking)
    {
        $bookingToDiscount = $booking->with('category')->whereHas('category', function($query) use($booking){
            $query->where('id', $booking->category_id);
        })->first();

        return view('admin.discount.create_discount', compact('bookingToDiscount'));
    }

    public function calculateDiscount(Request $request)
    {
        $percent = $request->percent/100;
        $amountToDiscount = $request->amount * $percent;
        $newAmount = $request->amount - $amountToDiscount;

        return $this->success("Discounted amount", 200, $newAmount);
    }

    public function applyDiscount(ApplyDiscountRequest $request)
    {
        try {
            Discount::create($request->validated());
            return redirect(route('users'))->with('success', 'Discount successfully Applied');
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}
