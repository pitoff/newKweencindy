<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'))){
            return back()->with('loginFailed', 'Whoops! Incorrect login details');
        }
        return redirect(route('users.dashboard'));

    }
}
