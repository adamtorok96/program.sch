<?php

use App\Models\Calendar;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('calendar:fake', function () {
   Calendar::create([
        'user_id'   => 1,
        'uuid'      => Uuid::generate()
   ]);
});

Artisan::command('google:test', function ()
{
    $google = resolve('App\Services\GoogleService');

    dd($google, $google->events());
});