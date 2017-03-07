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

    public function ajax()
    {
        $programs = Program::all();

        $programs->each(function(Program $program) {
            //$program->date2      = $program->date->format('Y. m. d. H:i');
            $program->user_name = $program->user->name;
        });

        $programs->makeHidden([
            'user'
        ]);

        return response()->json($programs);
    }

    public function edit(Program $program)
    {

    }

    public function update(Request $request, Program $program)
    {

    }

    public function show(Program $program)
    {
        return view('admin.programs.show', [
            'program' => $program
        ]);
    }

    public function accept(Program $program)
    {
        $c = app('Google_Client');
        $service = new \Google_Service_Calendar($c);

        $events = $service->events->listEvents('d5sc47eh6sq2jl803qh68ej7bk@group.calendar.google.com');

        dd($events, $events->getItems());
    }

    public function deny(Program $program)
    {

    }
}