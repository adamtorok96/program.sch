<?php

use App\Models\Circle;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Circle::class, function (Faker\Generator $faker) {
    return [
        'name'      => filter_var($faker->unique()->company, FILTER_SANITIZE_STRING),
        'active'    => $faker->boolean
    ];
});
