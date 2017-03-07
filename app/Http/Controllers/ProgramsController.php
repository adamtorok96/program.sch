<?php

namespace App\Http\Controllers;


use App\Models\Program;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ProgramsController extends Controller
{
    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()->route('programs.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $program = Program::create([
            'user_id'       => Auth::user()->id,
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
            'pr'            => 'nullable|string|max:255',
            'date'          => 'required|datetime',
            'location'      => 'nullable|string',
            'description'   => 'required|string',
            'display'       => 'nullable|boolean'
        ];
    }

    private function getValidationMessages()
    {
        return [

        ];
    }


}