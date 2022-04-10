<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::get('/', function () {
    return view('main.index');
});

//auth routes
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//reset password routes
Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordResetLink']);
Route::get('/reset-password/{passwordToken}/user/{email}', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
Route::put('/reset-password/{passwordToken}/user/{email}', [ResetPasswordController::class, 'updateNewPass']);

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

Route::middleware(['verified', 'auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/learn-make-up', function(){ 
        return view('learning.index');
    });

    Route::get('/make-up-session', [BookingController::class, 'index'])->name('makeUpSession');
});
