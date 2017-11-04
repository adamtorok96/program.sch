<?php

namespace App\Http\Controllers;


use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user'      => Auth::user()
        ]);
    }
}