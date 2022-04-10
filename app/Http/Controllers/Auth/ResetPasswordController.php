<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.forgot-password');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $passwordToken = Str::random(20);
        $getUser = User::where('email', $request->email)->first();
        $time = date('H:i:s');
        $expire_at = date('H:i:s', strtotime('+5 minutes', strtotime($time)));

        if(!$getUser){
            return back()->with('UserNotExist', 'User could not be found');
        }

        $reset = DB::table('password_resets')->where('email', $request->email)->first();
        if(!$reset){
            $createReset = DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $passwordToken,
                'expire_at' => $expire_at
            ]);
            if(!$createReset){
                return back()->with('LinkNotSent', 'Whoops please something went wrong');
            }
            Mail::to($request->email)->send(new ResetPassword($passwordToken, $request->email));
            return back()->with('LinkSent', 'Password reset link has been sent to your email');
        }else{
            $updateReset = DB::table('password_resets')->where('email', $request->email)->update([
                'token' => $passwordToken,
                'expire_at' => $expire_at
            ]);
            if(!$updateReset){
                return back()->with('LinkNotSent', 'Whoops please something went wrong');
            }
            Mail::to($request->email)->send(new ResetPassword($passwordToken, $request->email));
            return back()->with('LinkSent', 'Password reset link has been sent to your email');
        }

    }

    public function resetPassword(Request $request)
    {
        return view('auth.update-password', [
            'passwordToken' => $request->passwordToken,
            'email' => $request->email
        ]);
    }

    public function updateNewPass(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $getUser = DB::table('password_resets')->where('email', $request->email)->first();
        $tokenExpireTime = $getUser->expire_at;
        $currentTime = date('H:i:s');

        if ($getUser->token !== $request->passwordToken) {

            return back()->with('tokenDoesNotMatch', 'token does not match');
        }

        if (!($currentTime > $tokenExpireTime)) {
            $updatePass = User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);
            if ($updatePass) {
                DB::table('password_resets')->where('email', $request->email)->delete();
                return redirect(route('login'))->with('PasswordResetSuccess', 'Password has been reset');
            }
        }

        return redirect(route('forgot-password'))->with('LinkExpired', 'Password reset link has expired, get a new one');
    }
}
