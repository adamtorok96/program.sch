<?php

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
    //Route::get('create', 'CirclesController@create')->name('create');
    //Route::post('store', 'CirclesController@store')->name('store');
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
    Route::get('toggle/pr/{user}/{circle}', 'UsersController@togglePr')->name('toggle.pr');

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
    Route::get('resorts', 'Ajax\ResortsController@index')->name('resorts.index');
    Route::get('circles', 'Ajax\CirclesController@index')->name('circles.index');
    Route::get('programs', 'Ajax\ProgramsController@index')->name('programs.index');
    Route::get('users', 'Ajax\UsersController@index')->name('users.index');
    Route::get('users/circle/{circle}', 'Ajax\UsersController@circle')->name('users.circle');
    Route::get('locations', 'Ajax\LocationsController@index')->name('locations.index');

//    Route::get('programs', 'AjaxController@programs')->name('programs');
//    Route::get('resorts', 'AjaxController@resorts')->name('resorts');
//    Route::get('circles', 'AjaxController@circles')->name('circles');
//    Route::get('circles/{circle}/users', 'AjaxController@circlesUsers')->name('circles.users');
//    Route::get('users', 'AjaxController@users')->name('users');
//    Route::get('locations', 'AjaxController@locations')->name('locations');
    //Route::get('posters', 'AjaxController@posters')->name('posters');
});