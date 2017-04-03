<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\Location;
use App\Models\Program;
use App\Models\Resort;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function circles()
    {
        $circles = Circle::orderBy('name')->get();

        $circles->each(function (Circle $circle) {
            $circle->resort_id      = $circle->resort == null ? null : $circle->resort->id;
            $circle->resort_name    = $circle->resort == null ? null : $circle->resort->name;
        });

        return response()->json($circles);
    }

    public function programs(Request $request)
    {
        $programs = Program::orderBy('from', 'DESC');

        if( $request->has('only_poster') )
            $programs->where('display_poster', true);

        if( $request->has('only_email') )
            $programs->where('display_email', true);

        $programs = $programs->get();

        $programs->each(function(Program $program) {
            $program->date      = $program->fullDate();
            $program->user_name = $program->user->name;
        });

        $programs->makeHidden([
            'user'
        ]);

        return response()->json($programs);
    }

    public function circlesUsers(Circle $circle)
    {
        return response()->json($circle->users()->orderBy('name')->get());
    }

    public function resorts()
    {
        return response()->json(Resort::orderBy('name')->get());
    }

    public function users()
    {
        return response()->json(User::orderBy('name')->get());
    }

    public function locations()
    {
        return response()->json(Location::orderBy('name')->get());
    }
}