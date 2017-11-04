<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramsController extends Controller
{
    public function index()
    {
        /**
         * @var $programs Collection
         */
        $programs = Program::paginate(15);

        $programs->makeHidden([
            'poster',
            'description',
            'display_poster',
            'display_email',
            'display_site'
        ]);

        return response()->json($programs);
    }

    public function show(Program $program)
    {
        $program->makeHidden([
            'poster',
            'display_poster',
            'display_email',
            'display_site'
        ]);

        return response()->json($program);
    }
}