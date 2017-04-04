<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\Resort;
use Auth;

class FiltersController extends Controller
{
    public function edit()
    {
        return view('filters.edit', [
            'resorts'   => Resort::orderBy('name')->get()
        ]);
    }

    public function enable()
    {
        Auth::user()->update([
            'filter' => true
        ]);

        return redirect()->route('profile.index');
    }

    public function disable()
    {
        Auth::user()->update([
            'filter' => false
        ]);

        return redirect()->route('profile.index');
    }

    public function toggle(Circle $circle)
    {
        if( Auth::user()->isInFilter($circle) )
            Auth::user()->filters()->detach($circle->id);
        else
            Auth::user()->filters()->attach($circle->id);

        return response()->json(['success' => true]);
    }
}