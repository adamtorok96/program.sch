<?php

namespace app\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', [
            'location' => $location
        ]);
    }

    public function update(Request $request, Location $location)
    {

    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index');
    }
}