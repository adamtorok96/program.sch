<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Program;
use App\Models\Resort;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

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
            'resorts' => Resort::orderBy('name')->get(),
            'locations' => Location::all()
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('admin.programs.edit', [
                    'program' => $program
                ])
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $program->update([
            'name'                  => $request->name,
            'from'                  => new Carbon($request->from),
            'to'                    => new Carbon($request->to),
            'summary'               => $request->summary,
            'description'           => $request->description,
            'location'              => $request->location,
            'website'               => $request->website,
            'facebook_event_id'     => $request->facebook_event_id,
            'display_poster'        => $request->display_poster,
            'display_email'         => $request->display_email
        ]);

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

    private function getValidator(Request $request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidationMessages());
    }

    private function getValidations()
    {
        return [

        ];
    }

    private function getValidationMessages()
    {
        return [

        ];
    }
}