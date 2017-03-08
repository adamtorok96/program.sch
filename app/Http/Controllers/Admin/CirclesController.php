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

        if( $validator->fails() ) {
            return redirect()->route('admin.circles.edit', [
                'circle' => $circle
            ])->withErrors($validator)->withInput($request->all());
        }

        $circle->update([
            'name'      => $request->name,
            'resort_id' => $request->get('resort', null)
        ]);

        return redirect()->route('admin.circles.show', [
            'circle' => $circle
        ]);
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

    public function activate(Circle $circle)
    {
        $circle->update([
            'active' => true
        ]);

        return redirect()->route('admin.circles.show', [
            'circle' => $circle
        ]);
    }

    public function deactivate(Circle $circle)
    {
        $circle->update([
            'active' => false
        ]);

        return redirect()->route('admin.circles.show', [
            'circle' => $circle
        ]);
    }

    private function getValidator($request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidatorMessages());
    }

    private function getValidations()
    {
        return [
            'name'      => 'required|string|max:255',
            'resort'    => 'nullable|numeric|exists:resorts,id'
        ];
    }

    private function getValidatorMessages()
    {
        return [

        ];
    }
}