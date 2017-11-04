<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Database\Eloquent\Collection;

class CirclesController extends Controller
{
    public function index()
    {
        /**
         * @var $circles Collection
         */
        $circles = Circle::all();

        $circles->makeHidden([
            'active'
        ]);

        return response()->json($circles);
    }

    public function show(Circle $circle)
    {
        $circle->makeHidden([
            'active'
        ]);

        return response()->json($circle);
    }
}