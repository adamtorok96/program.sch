<?php

namespace App\Http\Controllers;


use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
           'user' => Auth::user()
        ]);
    }

    public function enableFilters()
    {
        Auth::user()->update([
            'filter' => true
        ]);

        return redirect()->route('profile.index');
    }

    public function disableFilters()
    {
        Auth::user()->update([
            'filter' => false
        ]);

        return redirect()->route('profile.index');
    }
}