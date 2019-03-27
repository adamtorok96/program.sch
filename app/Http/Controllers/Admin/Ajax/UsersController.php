<?php


namespace App\Http\Controllers\Admin\Ajax;


use AdamTorok96\BootstrapTableAjax\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return AjaxResponse::base(User::query(), $request)
            ->search([
                'name',
                'email'
            ])
            ->orderBy('name')
            ->get()
        ;
    }

    public function circle(Request $request, Circle $circle)
    {
        return AjaxResponse::base($circle->users(), $request)
            ->search([
                'name',
                'email'
            ])
            ->orderBy('name')
            ->get()
        ;
    }
}