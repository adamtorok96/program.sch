<?php


namespace App\Http\View\Composers;


use App\Models\Circle;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.navbar', function (\Illuminate\View\View $view) {
            if( Auth::check() ) {
                $circles = Circle::WherePRManager(Auth::user())
                    ->orderBy('name')
                    ->get()
                ;

                $view->with('circles', $circles);
            }
        });
    }

}