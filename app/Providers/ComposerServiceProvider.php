<?php

namespace App\Providers;

use App\Models\Circle;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.navbar', function(\Illuminate\View\View $view) {
            $circles = Auth::check()
                ? Circle::wherePRManager(Auth::user())->orderBy('name')->get()
                : []
            ;

           $view->with('circles', $circles);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
