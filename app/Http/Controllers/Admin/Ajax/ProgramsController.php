<?php


namespace App\Http\Controllers\Admin\Ajax;


use AdamTorok96\BootstrapTableAjax\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
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
            ->when($request->has('only_poster'), function (Builder $query) {
                $query->where('display_poster', true);
            })
            ->when($request->has('only_email'), function (Builder $query) {
                $query->where('display_email', true);
            })
            ->latest()
            ->get()
        ;
    }
}