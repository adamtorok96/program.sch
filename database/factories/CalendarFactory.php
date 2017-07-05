<?php

use App\Models\Calendar;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Calendar::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid
    ];
});
