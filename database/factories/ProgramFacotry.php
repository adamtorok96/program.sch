<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Circle;
use App\Models\Program;
use App\Models\User;
use Carbon\Carbon;

$factory->define(Program::class, function (Faker\Generator $faker) {
    $date = Carbon::now()->addDays(random_int(-5, 10));
    $to = (new Carbon($date))->addHour(random_int(1, 12));

    $locations = ['ENT', 'FNT', '102', '103'];

    return [
        'user_id'           => User::inRandomOrder()->firstOrFail()->id,
        'circle_id'         => Circle::inRandomOrder()->firstOrFail()->id,
        'name'              => $faker->words(random_int(1, 3), true),
        'from'              => $date,
        'to'                => $to,
        'location'          => $locations[array_rand($locations)],
        'website'           => $faker->boolean ? $faker->url : null,
        'summary'           => $faker->text(random_int(50, 200)),
        'description'       => $faker->words(random_int(5, 40), true)
    ];
});
