<?php


namespace App\Http\Controllers\Admin\Ajax;


use AdamTorok96\BootstrapTableAjax\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index(Request $request)
    {
        return AjaxResponse::base(Location::query(), $request)
            ->search([
                'name'
            ])
            ->get()
        ;
    }
}