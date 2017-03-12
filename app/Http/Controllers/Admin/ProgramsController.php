<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Resort;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        return view('admin.programs.index');
    }

    public function create()
    {
        return view('admin.programs.create', [
            'resorts' => Resort::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {

    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', [
            'program' => $program,
            'resorts' => Resort::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $program->update([
            'name' => $request->name
        ]);
        /*
         * TODO: finish it
         */

        return redirect()->route('admin.programs.show', [
            'program' => $program
        ]);
    }

    public function show(Program $program)
    {
        return view('admin.programs.show', [
            'program' => $program
        ]);
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index');
    }
}