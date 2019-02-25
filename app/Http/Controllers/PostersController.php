<?php


namespace App\Http\Controllers;


use App\Models\Poster;

class PostersController extends Controller
{
    public function index()
    {
        $posters = Poster::latest()->paginate(16);

        return view('posters.index', [
            'posters' => $posters
        ]);
    }
}