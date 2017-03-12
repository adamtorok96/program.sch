<?php

namespace App\Http\Controllers;


use App\Models\User;
use Auth;

class TestController extends Controller
{
    public function login()
    {
        $user = User::all()->first();

        Auth::login($user);

        return redirect()->route('index');
    }
}