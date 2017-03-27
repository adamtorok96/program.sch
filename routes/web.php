<?php

Route::get('/', 'CalendarController@index')->name('index');

Route::group(['prefix' => 'test', 'as' => 'test.'], function ()
{
    Route::get('login', 'TestController@login');
    Route::get('admin', 'TestController@makeAdmin');
});

Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function()
{
    Route::get('calendar/{uuid}.ics', 'CalendarController@calendar')->name('calendar');
    Route::get('{week?}', 'CalendarController@index')->name('index');
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function()
{
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('{provider}/redirect', 'AuthController@redirect')->name('redirect');
    Route::get('{provider}/callback', 'AuthController@callback')->name('callback');
});

Route::group(['middleware' => 'auth'], function()
{
    Route::group(['prefix' => 'programs', 'as' => 'programs.'], function()
    {
        Route::get('info', 'ProgramsController@info')->name('info');
        Route::get('create/{circle}', 'ProgramsController@create')->name('create')->middleware(['pr_manager']);
        Route::post('store/{circle}', 'ProgramsController@store')->name('store')->middleware(['pr_manager']);
        Route::get('destroy/{program}', 'ProgramsController@destroy')->name('destroy')->middleware(['pr_manager']);
        Route::get('{program}', 'ProgramsController@show')->name('show');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function()
    {
       Route::get('/', 'ProfileController@index')->name('index');
       Route::get('enable/filters', 'ProfileController@enableFilters')->name('enable.filters');
       Route::get('disable/filters', 'ProfileController@disableFilters')->name('disable.filters');
       Route::get('calendar/create', 'CalendarController@create')->name('calendar.create');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin']], function ()
{
    Route::get('/', 'IndexController@index')->name('index');

    Route::group(['prefix' => 'programs', 'as' => 'programs.'], function()
    {
        Route::get('/', 'ProgramsController@index')->name('index');
        Route::get('create', 'ProgramsController@create')->name('create');
        Route::post('store', 'ProgramsController@store')->name('store');
        Route::get('edit/{program}', 'ProgramsController@edit')->name('edit');
        Route::post('update/{program}', 'ProgramsController@update')->name('update');
        Route::get('destroy/{program}', 'ProgramsController@destroy')->name('destroy');
        Route::get('{program}', 'ProgramsController@show')->name('show');
    });

    Route::group(['prefix' => 'resorts', 'as' => 'resorts.'], function()
    {
        Route::get('/', 'ResortsController@index')->name('index');
        Route::get('create', 'ResortsController@create')->name('create');
        Route::post('store', 'ResortsController@store')->name('store');
        Route::get('edit/{resort}', 'ResortsController@edit')->name('edit');
        Route::post('update/{resort}', 'ResortsController@update')->name('update');
        Route::get('{resort}', 'ResortsController@show')->name('show');
    });

    Route::group(['prefix' => 'circles', 'as' => 'circles.'], function()
    {
        Route::get('/', 'CirclesController@index')->name('index');
        Route::get('create', 'CirclesController@create')->name('create');
        Route::post('store', 'CirclesController@store')->name('store');
        Route::get('edit/{circle}', 'CirclesController@edit')->name('edit');
        Route::post('update/{circle}', 'CirclesController@update')->name('update');
        Route::get('activate/{circle}', 'CirclesController@activate')->name('activate');
        Route::get('deactivate/{circle}', 'CirclesController@deactivate')->name('deactivate');
        Route::get('{circle}', 'CirclesController@show')->name('show');
    });

    Route::group(['prefix' => 'locations', 'as' => 'locations.'], function()
    {
        Route::get('/', 'LocationsController@index')->name('index');
        Route::get('create', 'LocationsController@create')->name('create');
        Route::post('store', 'LocationsController@store')->name('store');
        Route::get('edit/{location}', 'LocationsController@edit')->name('edit');
        Route::post('update/{location}', 'LocationsController@update')->name('update');
        Route::post('destroy/{location}', 'LocationsController@destroy')->name('destroy');
        Route::get('{location}', 'LocationsController@show')->name('show');
    });

    Route::group(['prefix' => 'posters', 'as' => 'posters.'], function()
    {
        Route::get('/', 'PostersController@index')->name('index');
        Route::get('destroy/{poster}', 'PostersController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function()
    {
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('edit/{user}', 'UsersController@edit')->name('edit');
        Route::post('update/{user}', 'UsersController@update')->name('update');

        Route::group(['prefix' => 'promote', 'as' => 'promote.'], function()
        {
            Route::get('admin/{user}', 'UsersController@promoteAdmin')->name('admin');
        });

        Route::group(['prefix' => 'demote', 'as' => 'demote.'], function()
        {
            Route::get('admin/{user}', 'UsersController@demoteAdmin')->name('admin');
        });

        Route::get('{user}', 'UsersController@show')->name('show');
    });

    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function()
    {
        Route::get('programs', 'AjaxController@programs')->name('programs');
        Route::get('resorts', 'AjaxController@resorts')->name('resorts');
        Route::get('circles', 'AjaxController@circles')->name('circles');
        Route::get('circles/{circle}/users', 'AjaxController@circlesUsers')->name('circles.users');
        Route::get('users', 'AjaxController@users')->name('users');
        Route::get('locations', 'AjaxController@locations')->name('locations');
        //Route::get('posters', 'AjaxController@posters')->name('posters');
    });
});

/*
 * "php artisan clear-compiled",
            "php artisan view:clear",
            "php artisan cache:clear",
            "composer dump-autoload",
            "php artisan migrate:refresh --seed --env production"
 */