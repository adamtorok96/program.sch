<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Poster;

class PostersController extends Controller
{
    public function index()
    {
        return view('admin.posters.index', [
            'posters' => Poster::orderBy('created_at', 'desc')->paginate(9)
        ]);
    }

    public function destroy(Poster $poster)
    {
        $poster->delete();

        return redirect()->route('admin.posters.index');
    }
}