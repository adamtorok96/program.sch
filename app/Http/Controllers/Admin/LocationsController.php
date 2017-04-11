<?php

namespace app\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Validator;

class LocationsController extends Controller
{
    public function index()
    {
        return view('admin.locations.index');
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('admin.locations.create')
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $location = Location::create([
           'name' => $request->name
        ]);

        return redirect()->route('admin.locations.show', [
            'location' => $location
        ]);
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', [
            'location' => $location
        ]);
    }

    public function update(Request $request, Location $location)
    {
        $validator = $this->getValidator($request);

        if( $validator->fails() ) {
            return redirect()
                ->route('admin.locations.create')
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $location->update([
           'name' => $request->name
        ]);

        return redirect()->route('admin.locations.show', [
            'location' => $location
        ]);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index');
    }

    public function show(Location $location)
    {
        return view('admin.locations.show', [
            'location' => $location
        ]);
    }

    private function getValidator(Request $request)
    {
        return Validator::make($request->all(), $this->getValidations(), $this->getValidationMessages());
    }

    private function getValidations()
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    private function getValidationMessages()
    {
        return [
            'name.required' => 'A helyszín nevének megadása kötelező!',
            'name.string'   => 'A helyszín nevének karakterláncnak kell lennie!',
            'name.max'      => 'A helyszín nevének hossza maximum 255 karakter lehet!'
        ];
    }
}