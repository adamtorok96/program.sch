<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\Location;
use App\Models\Program;
use App\Models\Resort;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'programs'  => Program::count(),
            'resorts'   => Resort::count(),
            'circles'   => Circle::count(),
            'users'     => User::count(),
            'locations' => Location::count()
        ]);
    }
}