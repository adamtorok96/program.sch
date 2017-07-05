<?php

use App\Models\Resort;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Resort::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->unique()->company
    ];
});
