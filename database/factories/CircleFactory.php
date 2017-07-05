<?php

use App\Models\Circle;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Circle::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->unique()->company,
        'active'    => $faker->boolean
    ];
});
