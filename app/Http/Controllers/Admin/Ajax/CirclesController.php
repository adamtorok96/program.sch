<?php


namespace App\Http\Controllers\Admin\Ajax;


use AdamTorok96\BootstrapTableAjax\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;

class CirclesController extends Controller
{
    public function index(Request $request)
    {
        return AjaxResponse::base(Circle::query(), $request)
            ->with([
                'resort'
            ])
            ->orderBy('name')
            ->get()
        ;
    }
}