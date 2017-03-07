<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'remember_token'    => str_random(10),
    ];
});
