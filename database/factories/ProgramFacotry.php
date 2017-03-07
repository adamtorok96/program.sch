<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Circle;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;

static $date;

$factory->define(Program::class, function (Faker\Generator $faker) {
    return [
        'user_id'           => User::inRandomOrder()->firstOrFail()->id,
        'circle_id'         => Circle::inRandomOrder()->firstOrFail()->id,
        'name'              => $faker->words(random_int(1, 3), true),
        'from'              => $date = $faker->dateTimeBetween('-2 days', '+2 days'),
        'to'                => $faker->dateTimeBetween('+1 days', '+3 days'),
        'location'          => 'ENT',
        'summary'           => $faker->text(random_int(50, 200)),
        'description'       => $faker->words(random_int(5, 40), true)
    ];
});
