<?php

Route::get('/', 'CalendarController@index')->name('index');

Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function()
{
    Route::get('calendar/{uuid}.ics', 'CalendarController@calendar')->name('calendar');
    Route::get('{week?}', 'CalendarController@index')->name('index');
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function()
{
    Route::get('logout', 'AuthController@logout')->name('logout')->middleware('auth');
    Route::get('{provider}/redirect', 'AuthController@redirect')->name('redirect');
    Route::get('{provider}/callback', 'AuthController@callback')->name('callback');
});

Route::group(['middleware' => 'auth'], function()
{
    Route::group(['prefix' => 'programs', 'as' => 'programs.'], function()
    {
        Route::get('info', 'ProgramsController@info')->name('info');
        Route::get('create/{circle}', 'ProgramsController@create')->name('create')->middleware(['circle.pr.manager']);
        Route::post('store/{circle}', 'ProgramsController@store')->name('store')->middleware(['circle.pr.manager']);
        Route::get('edit/{program}', 'ProgramsController@edit')->name('edit')->middleware(['program.pr.manager']);
        Route::post('update/{program}', 'ProgramsController@update')->name('update')->middleware(['program.pr.manager']);
        Route::get('destroy/{program}', 'ProgramsController@destroy')->name('destroy')->middleware(['program.pr.manager']);
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function()
    {
       Route::get('/', 'ProfileController@index')->name('index');

       Route::group(['prefix' => 'filters', 'as' => 'filters.'], function()
       {
           Route::get('enable', 'FiltersController@enable')->name('enable');
           Route::get('disable', 'FiltersController@disable')->name('disable');
           Route::get('edit', 'FiltersController@edit')->name('edit');
           Route::post('toggle/{circle}', 'FiltersController@toggle')->name('toggle');
       });

       Route::get('calendar/create', 'CalendarController@create')->name('calendar.create');
    });
});

Route::get('programs/{program}', 'ProgramsController@show')->name('programs.show');

if( config('app.debug') ) {
    Route::group(['prefix' => 'test', 'as' => 'test.'], function ()
    {
        Route::get('login', 'TestController@login');
        Route::get('admin', 'TestController@makeAdmin');
    });
}