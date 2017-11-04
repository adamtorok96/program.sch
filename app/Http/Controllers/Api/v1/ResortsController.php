<?php

namespace app\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Resort;

class ResortsController extends Controller
{
    public function index()
    {
        $resorts = Resort::all();

        return response()->json($resorts);
    }

    public function show(Resort $resort)
    {
        return response()->json($resort);
    }
}