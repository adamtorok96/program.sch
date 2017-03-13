<?php

namespace App\Http\Controllers;


use App\Models\Role;
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

    public function makeAdmin()
    {
        User::all()
            ->first()
            ->attach(Role::whereName('admin')->firstOrFail())
            ;

        return redirect()->route('index');
    }
}