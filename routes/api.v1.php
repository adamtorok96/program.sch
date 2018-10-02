<?php

# Circles
Route::apiResource('circles', 'CirclesController', [
    'only' => [
        'index',
        'show'
    ]
]);

# Resorts
Route::apiResource('resorts', 'ResortsController', [
    'only' => [
        'index',
        'show'
    ]
]);

# Programs
Route::apiResource('programs', 'ProgramsController');