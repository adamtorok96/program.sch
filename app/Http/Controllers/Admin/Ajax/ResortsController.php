<?php


namespace App\Http\Controllers\Admin\Ajax;


use AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Resort;
use Illuminate\Http\Request;

class ResortsController extends Controller
{
    public function index(Request $request)
    {
        return AjaxResponse::base(Resort::query(), $request)
            ->search([
                'name'
            ])
            ->withCount([
                'circles'
            ])
            ->get()
        ;
    }
}