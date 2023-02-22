<?php

use App\Models\User;

if(!function_exists('admin')){
    function admin(){
        return auth()->user()->role === User::ADMIN;
    }
}

if(!function_exists('defaultUser')){
    function defaultUser(){
        return auth()->user()->role === User::DEFAULT;
    }
}