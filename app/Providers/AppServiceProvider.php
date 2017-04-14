<?php

namespace App\Providers;

use Blade;
use Carbon\Carbon;
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
        Carbon::setLocale(config('app.locale'));

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');

        $socialite->extend('sch', function ($app) use ($socialite) {
            return $socialite->buildProvider(SchProvider::class, $app['config']['services.sch']);
        });

        Blade::directive('prmanagerat', function ($expression) {
            return '<?php if( Auth::check() && Auth::user()->isPRManagerAt('. $expression .') ) { ?>';
        });
        
        Blade::directive('endprmanagerat', function ($expression) {
            return  '<?php } ?>';
        });

        Blade::directive('hunDays', function ($expression) {
            return implode([
                '<?php ',
                'switch(',
                $expression,
                ') {',
                'case 1: echo "Hétfő"; break;',
                'case 2: echo "Kedd"; break;',
                'case 3: echo "Szerda"; break;',
                'case 4: echo "Csütörtök"; break;',
                'case 5: echo "Péntek"; break;',
                'case 6: echo "Szombat"; break;',
                'case 0: echo "Vasárnap"; break;',
                '} ?>'
            ]);
        });

        Blade::directive('nl2br', function($expression) {
            return implode([
               '<?php ',
                'foreach(explode("\n", ',
                $expression,
                ') as $line) {',
                'echo e($line)."<br>";',
                '} ?>'
            ]);
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
