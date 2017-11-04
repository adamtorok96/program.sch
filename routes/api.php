<?php

Route::prefix('v1')
    ->namespace('v1')
    ->group(base_path('routes/api.v1.php'))
;

/*
Route::group(['prefix' => 'v1', 'as' => 'v1', 'namespace' => 'v1'], function()
{
    require_once base_path('api.v1.php');
});
*/