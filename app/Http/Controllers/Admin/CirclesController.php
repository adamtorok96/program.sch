<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\Resort;
use Illuminate\Http\Request;
use Validator;

class CirclesController extends Controller
{
    public function index()
    {
        return view('admin.circles.index');
    }

    public function ajax()
    {
        $circles = Circle::orderBy('name')->get();

        $circles->each(function (Circle $circle) {
            $circle->resort_id      = $circle->resort == null ? null : $circle->resort->id;
            $circle->resort_name    = $circle->resort == null ? null : $circle->resort->name;
        });

        return response()->json($circles);
    }

    public function create()
    {
        return view('admin.circles.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(Circle $circle)
    {
        return view('admin.circles.edit', [
            'circle'    => $circle,
            'resorts'   => Resort::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Circle $circle)
    {
        $validator = $this->getValidator($request);
    }

    public function show(Circle $circle)
    {
        return view('admin.circles.show', [
            'circle' => $circle
        ]);
    }

    public function destroy(Circle $circle)
    {
        $circle->delete();

        return redirect()->route('admin.circles.index');
    }

    private function getValidator($request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidatorMessages());
    }

    private function getValidations()
    {
        return [

        ];
    }

    private function getValidatorMessages()
    {
        return [

        ];
    }
}