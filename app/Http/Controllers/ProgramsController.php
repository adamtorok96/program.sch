<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\Program;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ProgramsController extends Controller
{
    public function create(Circle $circle)
    {
        return view('programs.create', [
            'circle' => $circle
        ]);
    }

    public function store(Request $request, Circle $circle)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()->route('programs.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $program = Program::create([
            'user_id'       => Auth::user()->id,
            'circle_id'     => $circle->id,
            'name'          => $request->name,
            'pr'            => $request->get('pr', null),
            'date'          => $request->date,
            'location'      => $request->location,
            'description'   => $request->description,
            'display'       => $request->display
        ]);

        return redirect()->route('programs.show', [
            'program' => $program
        ]);
    }

    public function show(Program $program)
    {
        return view('programs.show', [
            'program' => $program
        ]);
    }

    private function getValidator($request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidationMessages());
    }

    private function getValidations()
    {
        return [
            'name'          => 'required|string|max:255',
            'from'          => 'required|datetime',
            'to'            => 'datetime',
            'location'      => 'nullable|string',
            'summary'       => 'required|string|max:255',
            'description'   => 'nullable|string',
            'display'       => 'nullable|boolean'
        ];
    }

    private function getValidationMessages()
    {
        return [

        ];
    }


}