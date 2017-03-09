<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\Program;
use Auth;
use Carbon\Carbon;
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

       // dd($request->all());
        $program = Program::create([
            'user_id'       => Auth::user()->id,
            'circle_id'     => $circle->id,
            'name'          => $request->name,
            'from'          => new Carbon($request->from),
            'to'            => new Carbon($request->to),
            'summary'       => $request->summary,
            'description'   => $request->description,
            'location'      => $request->location
        ]);

        resolve('App\Services\GoogleService')->newEvent($program);

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
            'from'          => 'required|date',
            'to'            => 'date',
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