<?php


namespace App\Http\Controllers;


use App\Models\Circle;

class CirclesController extends Controller
{
    public function show(Circle $circle)
    {
        return view('circles.show', [
            'circle'        => $circle,
            'programs'      => $circle->programs()->latest()->take(5)->get(),
            'newsletters'   => $circle->newsletterMails()->latest()->take(5)->get()
        ]);
    }

    public function programs(Circle $circle)
    {
        return view('circles.programs', [
            'circle'    => $circle,
            'programs'  => $circle->programs()->latest()->paginate()
        ]);
    }

    public function newsletterMails(Circle $circle)
    {
        return view('circles.newsletters', [
            'circle'        => $circle,
            'newsletters'   => $circle->newsletterMails()->latest()->paginate()
        ]);
    }
}