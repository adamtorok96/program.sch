<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        return view('admin.programs.index');
    }

    public function edit(Program $program)
    {

    }

    public function update(Request $request, Program $program)
    {

    }

    public function show(Program $program)
    {
        return view('programs.show', [
            'program' => $program
        ]);
    }
}