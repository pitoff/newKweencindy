<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);

        if($createUser){
            if(auth()->attempt($request->only('email', 'password'))){

                event(new Registered($createUser));
                return redirect(route('verification.notice'));

            }
            // return redirect(route('login'))->with('success', 'Please Login and verify account');
        }
    }
}
