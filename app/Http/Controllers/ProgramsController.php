<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\Location;
use App\Models\Poster;
use App\Models\Program;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

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

    public function store(Request $request, Circle $circle)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()->route('programs.create', [
                'circle' => $circle
            ])
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $program = Program::create([
            'user_id'               => Auth::user()->id,
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

    public function update(Request $request, Program $program)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('programs.edit')
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

    private function getValidator($request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidationMessages());
    }

    private function getValidations()
    {
        return [
            'name'              => 'required|string|max:255',
            'from'              => 'required|date',
            'to'                => 'required|date|after:from',
            'location'          => 'nullable|string',
            'summary'           => 'required|string|max:255',
            'description'       => 'nullable|string',
            'display_poster'    => 'nullable|boolean',
            'display_email'     => 'nullable|boolean',
            'display_site'      => 'nullable|boolean',
            'facebook_event_id' => 'nullable|integer',
            'website'           => 'nullable|string|url|max:255',
            'poster'            => 'nullable|image'
        ];
    }

    private function getValidationMessages()
    {
        return [
            'name.required'                 => 'A program nevének megadása kötelező!',
            'name.string'                   => 'A program nevének karakterláncnak kell lennie!',
            'name.max'                      => 'A program neve maximálisan 255 karakter hosszú lehet!',
            'from.required'                 => 'A program kezdetének megadása kötelező!',
            'from.date'                     => 'A program kezdetének formátuma hibás!',
            'to.required'                   => 'A program végének megadása kötelező!',
            'to.date'                       => 'A program végének formátuma hibás!',
            'to.after'                      => 'A program végének a program kezdete után kell lennie!',
            'summary.required'              => 'A program rövid összefoglalásának megadása kötelező!',
            'summary.string'                => 'A program rövid összefoglalásának karakterláncnak kell lennie!',
            'summary.max'                   => 'A program rövid összefoglalásának hossza maximum 255 karakter hosszú lehet!',
            'location.nullable'             => 'location.nullable',
            'location.string'               => 'location.string',
            'description.string'            => 'description.string',
            'display_poster.boolean'        => 'display_poster.boolean',
            'display_email.boolean'         => 'display_email.boolean',
            'display_site.boolean'          => 'display_site.boolean',
            'facebook_event_id.integer'     => 'A Facebook esemény azonosítónak számnak kell lennie!',
            'website.string'                => 'website.string',
            'website.url'                   => 'A weboldal címe hibás formátumú!',
            'website.max'                   => 'A weboldal címének hossza maximum 255 karakter hosszú lehet!',
            'poster.image'                  => 'A plakátnak képnek kell lennie!'
        ];
    }


}