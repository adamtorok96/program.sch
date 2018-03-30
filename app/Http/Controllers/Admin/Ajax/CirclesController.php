<?php

namespace App\Http\Controllers\Admin\Ajax;

use AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;

class CirclesController extends Controller
{
    public function index(Request $request)
    {
        return AjaxResponse::base(Circle::query(), $request)
            ->search([
                'name'
            ])
            ->with([
                'resort'
            ])
            ->get()
        ;
    }
}