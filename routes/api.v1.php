<?php

Route::apiResource('circles', 'CirclesController', [
    'only' => [
        'index',
        'show'
    ]
]);

Route::apiResource('resorts', 'ResortsController', [
    'only' => [
        'index',
        'show'
    ]
]);

Route::apiResource('programs', 'ProgramsController', [
    'only' => [
        'index',
        'show'
    ]
]);