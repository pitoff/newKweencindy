<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Booking\CategoryController;
use App\Http\Controllers\Booking\PaymentController;
use App\Http\Controllers\Booking\PaymentMethodController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'homePage']);

//auth routes
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//reset password routes
Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordResetLink']);
Route::get('/reset-login-credentials/{urt}', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-login-credentials', [ResetPasswordController::class, 'updateNewPass'])->name('updateCredentials');

//email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

//resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent! Please check email your address');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//dashboard routes
Route::group(['middleware' => ['verified', 'auth']], function(){

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //booking
    Route::get('/booking-dashboard', [BookingController::class, 'index'])->name('booking');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('create_booking');
    Route::get('/already-booked', [BookingController::class, 'alreadyBooked'])->name('already_booked');
    Route::get('/my-booking/{id}', [BookingController::class, 'myBooking'])->name('my_booking');
    Route::get('/booking/edit/{id}', [BookingController::class, 'edit'])->name('edit_booking');
    Route::get('/booking-preview-modal/{id}', [BookingController::class, 'previewBooking'])->name('preview');
    Route::post('/booking/create', [BookingController::class, 'store']);
    Route::put('/booking/edit/{id}', [BookingController::class, 'update']);
    Route::put('/mark-booking-as-paid/{id}', [BookingController::class, 'markPaid'])->name('userMarkPaid');
    Route::delete('/booking/remove/{id}', [BookingController::class, 'delete'])->name('delete_booking');
    Route::get('/booking-categories/{id}', [BookingController::class, 'categoryDetails']);
    Route::get('/price-tags', [BookingController::class, 'priceTags'])->name('priceTags');

    Route::get('payment-details/{id}', [PaymentController::class, 'showPaymentDetails'])->name('payment_details');

    Route::resource('image-gallery', GalleryController::class);

    //paystack payment routes
    Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('payment');
    Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');

    //admin routes
    Route::group(['prefix' => 'admin', 'name' => 'admin.', 'middleware' => 'admin'], function(){
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('/bookings/user-discount/{userId}', [UserController::class, 'userBookings'])->name('userBookings');
        Route::get('/bookings/discount/{booking}', [UserController::class, 'createDiscount'])->name('createDiscount');
        Route::get('/calculate-discount', [UserController::class, 'calculateDiscount']);
        Route::post('/bookings/discount', [UserController::class, 'applyDiscount'])->name('applyDiscount');
        Route::resource('categories', CategoryController::class);
        Route::resource('payment', PaymentMethodController::class);
        Route::put('payment-activate/{id}', [PaymentMethodController::class, 'activate'])->name('paymentActivate');
        Route::put('payment-deactivate/{id}', [PaymentMethodController::class, 'deactivate'])->name('paymentDeactivate');
        Route::put('/accept-booking/{id}', [BookingController::class, 'accept'])->name('acceptBooking');
        Route::put('/decline-booking/{id}', [BookingController::class, 'decline'])->name('declineBooking');
        Route::put('/mark-booking-as-received/{id}', [BookingController::class, 'markReceived'])->name('adminMarkReceived');
        Route::put('/mark-booking-not-received/{id}', [BookingController::class, 'markNotReceived'])->name('adminMarkNotReceived');

    });

});
