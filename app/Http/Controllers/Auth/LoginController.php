<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->validated();

        if(!auth()->attempt($request->only('email', 'password'))){
            return back()->with('err', 'Whoops! Incorrect login details');
        }
        // return redirect(route('dashboard'));
        return redirect()->intended($this->redirectPath());

    }
}
