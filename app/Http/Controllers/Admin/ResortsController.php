<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Resort;
use Illuminate\Http\Request;
use Validator;

class ResortsController extends Controller
{
    public function index()
    {
        return view('admin.resorts.index');
    }

    public function create()
    {
        return view('admin.resorts.create');
    }

    public function store(Request $request)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('admin.resorts.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $resort = Resort::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.resorts.show', [
            'resort' => $resort
        ]);
    }

    public function edit(Resort $resort)
    {
        return view('admin.resorts.edit', [
            'resort' => $resort
        ]);
    }

    public function update(Request $request, Resort $resort)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('admin.resorts.edit', [
                    'resort' => $resort
                ])
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $resort->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.resorts.show', [
            'resort' => $resort
        ]);
    }

    public function show(Resort $resort)
    {
        return view('admin.resorts.show', [
            'resort' => $resort
        ]);
    }

    public function destroy(Resort $resort)
    {
        $resort->delete();

        return redirect()->route('admin.resorts.index');
    }

    private function getValidator($request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidatorMessages());
    }

    private function getValidations()
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    private function getValidatorMessages()
    {
        return [

        ];
    }
}