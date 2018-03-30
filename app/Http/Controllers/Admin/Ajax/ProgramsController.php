<?php


namespace App\Http\Controllers\Admin\Ajax;


use AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index(Request $request)
    {
        return AjaxResponse::base(Program::query(), $request)
            ->search([
                'name',
                'circle.name',
                'user.name'
            ])
            ->with([
                'circle',
                'user'
            ])
            ->get()
        ;
    }
}