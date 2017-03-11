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

       // dd($request->all());
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
            'facebook_event_id'     => $request->facebook_event_id
        ]);

        resolve('App\Services\GoogleService')->newEvent($program);

        if( $request->hasFile('poster') ) {
            $name = $program->id .'_' . sha1(str_random()) . '.' . $request->file('poster')->extension();

            if( $request->file('poster')->storeAs(
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
            'name'              => 'required|string|max:255',
            'from'              => 'required|date',
            'to'                => 'date',
            'location'          => 'nullable|string',
            'summary'           => 'required|string|max:255',
            'description'       => 'nullable|string',
            'display_poster'    => 'nullable|boolean',
            'display_site'      => 'nullable|boolean',
            'facebook_event_id' => 'nullable|numeric',
            'website'           => 'nullable|string|max:255',
            'poster'            => 'nullable|image'
        ];
    }

    private function getValidationMessages()
    {
        return [
            'name.required'                 => 'name.required',
            'name.string'                   => 'name.string',
            'name.max'                      => 'name.max',
            'from.required'                 => 'from.required',
            'from.date'                     => 'from.date',
            'to.date'                       => 'to.date',
            'location.nullable'             => 'location.nullable',
            'location.string'               => 'location.string',
            'description.string'            => 'description.string',
            'display_poster.boolean'        => 'display_poster.boolean',
            'display_site.boolean'          => 'display_site.boolean',
            'facebook_event_id.numeric'     => 'facebook_event_id.numeric',
            'website.string'                => 'website.string',
            'poster.image'                  => 'poster.image'
        ];
    }


}