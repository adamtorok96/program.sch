<?php

Route::get('/', 'CalendarController@index')->name('index');

# Calendar
Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function()
{
    Route::get('calendar/{uuid}.ics', 'CalendarController@calendar')->name('calendar');
    Route::get('{week?}', 'CalendarController@index')->name('index');
});

# Posters
Route::get('posters', 'PostersController@index')->name('posters.index');

# Auth
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function()
{
    Route::get('logout', 'AuthController@logout')->name('logout')->middleware('auth');
    Route::get('{provider}/redirect', 'AuthController@redirect')->name('redirect');
    Route::get('{provider}/callback', 'AuthController@callback')->name('callback');
});

# loggined
Route::group(['middleware' => 'auth'], function()
{
    # Programs
    Route::group(['prefix' => 'programs', 'as' => 'programs.'], function()
    {
        Route::get('info', 'ProgramsController@info')->name('info');

        Route::group(['middleware' => ['circle.pr.manager']], function()
        {
            Route::get('create/{circle}', 'ProgramsController@create')->name('create');
            Route::post('store/{circle}', 'ProgramsController@store')->name('store');
        });

        Route::group(['middleware' => ['program.pr.manager']], function()
        {
            Route::get('edit/{program}', 'ProgramsController@edit')->name('edit');
            Route::post('update/{program}', 'ProgramsController@update')->name('update');
            Route::get('destroy/{program}', 'ProgramsController@destroy')->name('destroy');
        });
    });

    # Newsletter Mails
    Route::group(['prefix' => 'newsletterMails', 'as' => 'newsletterMails.'], function()
    {
        Route::get('/', 'NewsletterMailsController@index')->name('index');
        Route::get('archive', 'NewsletterMailsController@archive')->name('archive');

        Route::group(['middleware' => ['circle.pr.manager']], function ()
        {
            Route::get('create/circle/{circle}', 'NewsletterMailsController@create')->name('create');
            Route::post('store/circle/{circle}', 'NewsletterMailsController@store')->name('store');
        });

        Route::get('{newsletterMail}', 'NewsletterMailsController@show')->name('show');
    });

    # Circles
    Route::group(['prefix' => 'circles', 'as' => 'circles.'], function()
    {
        Route::get('{circle}/programs', 'CirclesController@programs')->name('programs');
        Route::get('{circle}/newsletterMails', 'CirclesController@newsletterMails')->name('newsletterMails');
        Route::get('{circle}', 'CirclesController@show')->name('show');
    });

    # Api
    Route::group(['prefix' => 'info/api', 'as' => 'api.'], function()
    {
        Route::get('/', 'ApiController@index')->name('index');
    });

    # Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function()
    {
       Route::get('/', 'ProfileController@index')->name('index');

       Route::group(['prefix' => 'filters', 'as' => 'filters.'], function()
       {
           Route::get('enable', 'FiltersController@enable')->name('enable');
           Route::get('disable', 'FiltersController@disable')->name('disable');
           Route::get('edit', 'FiltersController@edit')->name('edit');
           Route::post('toggle/program/{circle}', 'FiltersController@toggleProgram')->name('toggle.program');
           Route::post('toggle/newsletter/{circle}', 'FiltersController@toggleNewsletter')->name('toggle.newsletter');
       });

       Route::get('calendar/create', 'CalendarController@create')->name('calendar.create');
    });
});

# Programs
Route::get('programs/{program}', 'ProgramsController@show')->name('programs.show');