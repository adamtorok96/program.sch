<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(190);

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');

        $socialite->extend('sch', function ($app) use ($socialite) {
            return $socialite->buildProvider(SchProvider::class, $app['config']['services.sch']);
        });

        Blade::directive('prmanagerat', function ($expression) {
            return '<?php if( Auth::user()->isPRManagerAt('. $expression .') ) { ?>';
        });
        
        Blade::directive('endprmanagerat', function ($expression) {
            return  '<?php } ?>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
