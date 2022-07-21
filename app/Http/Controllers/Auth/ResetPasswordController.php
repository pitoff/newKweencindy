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
            return back()->with('err', 'User could not be found');
        }

        $reset = DB::table('password_resets')->where('email', $request->email)->first();
        if(!$reset){
            $createReset = DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $passwordToken,
                'expire_at' => $expire_at
            ]);
            if(!$createReset){
                return back()->with('err', 'Whoops please something went wrong');
            }
            Mail::to($request->email)->send(new ResetPassword($passwordToken, $request->email));
            return back()->with('success', 'Password reset link has been sent to your email');
        }else{
            $updateReset = DB::table('password_resets')->where('email', $request->email)->update([
                'token' => $passwordToken,
                'expire_at' => $expire_at
            ]);
            if(!$updateReset){
                return back()->with('err', 'Whoops please something went wrong');
            }
            Mail::to($request->email)->send(new ResetPassword($passwordToken, $request->email));
            return back()->with('success', 'Password reset link has been sent to your email');
        }

    }

    public function resetPassword($passwordToken = null)
    {
        $getUser = DB::table('password_resets')->where('token', $passwordToken)->first(['email', 'token', 'expire_at']);
        if($getUser){
            if(date('H:i:s') > $getUser->expire_at){
                return redirect(route('forgot-password'))->with('warning', 'The password reset link has expired, please request a new reset password link');
            }

        }else{
            return back()->with('err', 'Whoops! Token error');
        }

        return view('auth.update-password', [
            'passwordToken' => $getUser->token,
            'email' => $getUser->email
        ]);
    }

    public function updateNewPass(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $updatePass = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
        if ($updatePass) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return redirect(route('login'))->with('success', 'Password has been reset');
        }

    }
}
