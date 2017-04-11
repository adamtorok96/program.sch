<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Program;
use App\Models\Resort;
use Auth;
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
            'resorts'   => Resort::orderBy('name')->get(),
            'locations' => Location::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('admin.programs.create')
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $program = Program::create([
            'user_id'           => Auth::user()->id,
            'circle_id'         => $request->circle,
            'name'              => $request->name,
            'from'              => new Carbon($request->from),
            'to'                => new Carbon($request->to),
            'location'          => $request->location,
            'summary'           => $request->summary,
            'description'       => $request->get('description', null),
            'website'           => $request->get('website', null),
            'facebook_event_id' => $request->get('facebook_event_id', null),
            'display_poster'    => $request->get('display_poster', false),
            'display_email'     => $request->get('display_email', false)
        ]);

        if( $request->hasFile('poster') ) {
            $this->uploadFile($program, $request,'poster');
        }

        return redirect()->route('admin.programs.show', [
           'program' => $program
        ]);
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', [
            'program'       => $program,
            'resorts'       => Resort::orderBy('name')->get(),
            'locations'     => Location::all()
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
            'circle_id'         => $request->circle,
            'name'              => $request->name,
            'from'              => new Carbon($request->from),
            'to'                => new Carbon($request->to),
            'location'          => $request->location,
            'summary'           => $request->summary,
            'description'       => $request->get('description', null),
            'website'           => $request->get('website', null),
            'facebook_event_id' => $request->get('facebook_event_id', null),
            'display_poster'    => $request->get('display_poster', false),
            'display_email'     => $request->get('display_email', false)
        ]);

        if( $request->hasFile('poster') ) {
            $this->uploadFile($program, $request,'poster');
        }

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

    private function uploadFile(Program $program, Request $request, $file)
    {
        if( $program->hasPoster() )
            $program->poster->delete();

        $name = $program->id .
            '_' .
            sha1(str_random()) .
            '.' .
            $request->file($file)->extension();

        if( $request->file($file)->storeAs(
            'posters',
            $name,
            'public'
        )) {
            Poster::create([
                'program_id'    => $program->id,
                'file'          => $name
            ]);
        }
    }

    private function getValidator(Request $request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidationMessages());
    }

    private function getValidations()
    {
        return [
            'circle'            => 'required|integer|exists:circles,id',
            'name'              => 'required|string|max:255',
            'from'              => 'required|date',
            'to'                => 'required|date|after:from',
            'location'          => 'required|string|max:255',
            'summary'           => 'required|string|max:255',
            'description'       => 'nullable|string',
            'website'           => 'nullable|string',
            'facebook_event_id' => 'nullable|integer',
            'display_poster'    => 'nullable|boolean',
            'display_site'      => 'nullable|boolean'
        ];
    }

    private function getValidationMessages()
    {
        return [

        ];
    }
}