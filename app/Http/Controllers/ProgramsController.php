<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProgram;
use App\Http\Requests\UpdateProgram;
use App\Models\Circle;
use App\Models\Location;
use App\Models\Poster;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function info()
    {
        return view('programs.info');
    }

    public function create(Circle $circle)
    {
        return view('programs.create', [
            'circle'    => $circle,
            'locations' => Location::all()
        ]);
    }

    public function store(StoreProgram $request, Circle $circle)
    {
        $this->httpCompletion($request);

        $program = Program::create([
            'user_id'               => $request->user()->id,
            'circle_id'             => $circle->id,
            'name'                  => $request->name,
            'from'                  => new Carbon($request->from),
            'to'                    => new Carbon($request->to),
            'summary'               => $request->summary,
            'description'           => $request->description,
            'location'              => $request->location,
            'website'               => $request->website,
            'facebook_event_id'     => $request->facebook_event_id,
            'display_poster'        => $request->get('display_poster', false),
            'display_email'         => $request->get('display_email', false)
        ]);

        if( $request->hasFile('poster') ) {
            $this->uploadFile($program, $request,'poster');
        }

        return redirect()->route('programs.show', [
            'program' => $program
        ]);
    }

    public function edit(Program $program)
    {
        return view('programs.edit', [
            'program'   => $program,
            'locations' => Location::all()
        ]);
    }

    public function update(UpdateProgram $request, Program $program)
    {
        $this->httpCompletion($request);
        $this->checkboxFix($request);

        $program->update([
            'name'                  => $request->name,
            'from'                  => new Carbon($request->from),
            'to'                    => new Carbon($request->to),
            'summary'               => $request->summary,
            'description'           => $request->description,
            'location'              => $request->location,
            'website'               => $request->website,
            'facebook_event_id'     => $request->facebook_event_id,
            'display_poster'        => $request->get('display_poster', false),
            'display_email'         => $request->get('display_email', false)
        ]);

        if( $request->hasFile('poster') ) {
            $this->uploadFile($program, $request,'poster');
        }

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

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('index');
    }

    private function uploadFile(Program $program, Request $request, $file)
    {
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
            if( $program->hasPoster() )
                $program->poster->delete();

            Poster::create([
                'program_id'    => $program->id,
                'file'          => $name
            ]);
        }
    }

    private function httpCompletion(Request $request)
    {
        if( $request->has('website') && !empty($request->website) &&
            (
                strpos($request->website, 'http://') !== 0 &&
                strpos($request->website, 'https://') !== 0
            ) ) {
            $request->merge(['website' => 'http://' . $request->website]);
        }
    }

    private function checkboxFix(Request $request)
    {
        $inputs = [
            'display_email',
            'display_poster'
        ];

        foreach ($inputs as $input) {
            if( !$request->has($input) || ($request->has($input) && $request->get($input) === null) )
                $request->merge([$input => false]);
        }
    }
}