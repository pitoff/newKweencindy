<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $request->validated();
        $createUser = User::create([
            'fullname' => $request->lastname.' '.$request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password
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
