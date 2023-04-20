<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //list of users, view remove and apply discount

    public function index(User $user)
    {
        $users = $user->paginate(5);
        return view('users.index', compact('users'));
    }

    // public function 
}
