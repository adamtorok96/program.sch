<?php

Route::group(['prefix' => 'programs', 'as' => 'programs.'], function()
{
    Route::get('/', 'ProgramsController@index')->name('index');
});

Route::get('resorts', 'ResortsController@index')->name('resorts.index');

Route::group(['prefix' => 'circles', 'as' => 'circles.'], function()
{
    Route::get('/', 'CirclesController@index')->name('index');
});

Route::group(['prefix' => 'users', 'as' => 'users.'], function()
{
    Route::get('users', 'UsersController@index')->name('index');
    Route::get('circle/{circle}', 'UsersController@circle')->name('circle');
});

Route::get('locations', 'LocationsController@index')->name('locations.index');