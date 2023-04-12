<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use ResponseTrait;

    public function createUser(RegisterRequest $request)
    {
        $request->validated();
        $createUser = User::create([
            'fullname' => $request->lastname.' '.$request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password
        ]);

        if($createUser){
            return $this->success("User created successfully", 201, new UserResource($createUser));
        }
        return $this->failure("resource could not be created", 400);

        // if($createUser){
        //     if(auth()->attempt($request->only('email', 'password'))){

        //         event(new Registered($createUser));
        //         return redirect(route('verification.notice'));

        //     }
        //     // return redirect(route('login'))->with('success', 'Please Login and verify account');
        // }
    }

    public function allUsers()
    {
        $users = User::all();
        return $this->success("User created successfully", 200, UserResource::collection($users));
    }
}
