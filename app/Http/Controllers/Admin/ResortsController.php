<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Resort;
use Illuminate\Http\Request;

class ResortsController extends Controller
{
    public function index()
    {
        return view('admin.resorts.index');
    }

    public function ajax()
    {
        return response()->json(Resort::orderBy('name')->get());
    }

    public function create()
    {
        return view('admin.resorts.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(Resort $resort)
    {

    }

    public function update(Request $request, Resort $resort)
    {

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
}