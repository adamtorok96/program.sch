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
        $query = Program::when($request->has('search'), function ($query) use($request) {
            return $query
                ->where('name', 'LIKE', '%' . $request->search .'%')
                ->orWhereHas('circle', function ($query) use($request) {
                    $query->where('name', 'LIKE', '%' . $request->search .'%');
                })
                ->orWhereHas('user', function ($query) use($request) {
                    $query->where('name', 'LIKE', '%' . $request->search .'%');
                })
            ;
        });

        if( $request->has('only_poster') )
            $query->where('display_poster', true);

        if( $request->has('only_email') )
            $query->where('display_email', true);

        $total = $query->count();

        $programs = $query
            ->skip($request->get('offset', 0))
            ->take($request->get('limit', 10))
            ->latest('from')
            ->get()
        ;

        $programs->each(function(Program $program) {
            $program->date          = $program->fullDate();
            $program->circle_name   = $program->circle->name;
            $program->user_name     = $program->user->name;
        });

        $programs->makeHidden([
            'user'
        ]);

        return response()->json([
            'total' => $total,
            'rows'  => $programs
        ]);
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