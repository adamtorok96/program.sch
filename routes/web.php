<?php

Route::get('/', 'CalendarController@index')->name('index');

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
        Route::get('create', 'ProgramsController@create')->name('create');
        Route::get('store', 'ProgramsController@store')->name('store');
        Route::get('{program}', 'ProgramsController@show')->name('show');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin']], function ()
{
    Route::get('/', 'IndexController@index')->name('index');

    Route::group(['prefix' => 'programs', 'as' => 'programs.'], function()
    {
        Route::get('/', 'ProgramsController@index')->name('index');
        Route::get('ajax', 'ProgramsController@ajax')->name('ajax');
        Route::get('create', 'ProgramsController@create')->name('create');
        Route::post('store', 'ProgramsController@store')->name('store');
        Route::get('edit/{program}', 'ProgramsController@edit')->name('edit');
        Route::post('update/{program}', 'ProgramsController@update')->name('update');
        Route::get('accept/{program}', 'ProgramsController@accept')->name('accept');
        Route::get('deny/{program}', 'ProgramsController@deny')->name('deny');
        Route::get('{program}', 'ProgramsController@show')->name('show');
    });

    Route::group(['prefix' => 'resorts', 'as' => 'resorts.'], function()
    {
        Route::get('/', 'ResortsController@index')->name('index');
        Route::get('ajax', 'ResortsController@ajax')->name('ajax');
        Route::get('create', 'ResortsController@create')->name('create');
        Route::post('store', 'ResortsController@store')->name('store');
        Route::get('edit/{resort}', 'ResortsController@edit')->name('edit');
        Route::post('update/{resort}', 'ResortsController@update')->name('update');
        Route::get('{resort}', 'ResortsController@show')->name('show');
    });

    Route::group(['prefix' => 'circles', 'as' => 'circles.'], function()
    {
        Route::get('/', 'CirclesController@index')->name('index');
        Route::get('ajax', 'CirclesController@ajax')->name('ajax');
        Route::get('create', 'CirclesController@create')->name('create');
        Route::post('store', 'CirclesController@store')->name('store');
        Route::get('edit/{circle}', 'CirclesController@edit')->name('edit');
        Route::post('update/{circle}', 'CirclesController@update')->name('update');
        Route::get('{circle}', 'CirclesController@show')->name('show');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function()
    {
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('ajax', 'UsersController@ajax')->name('ajax');
        Route::get('edit/{user}', 'UsersController@edit')->name('edit');
        Route::post('update/{user}', 'UsersController@update')->name('update');
        Route::get('{user}', 'UsersController@show')->name('show');
    });
});