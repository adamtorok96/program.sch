<?php


use App\Models\SocialAccount;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(SocialAccount::class, function (Faker\Generator $faker) {
    static $providers = [
        'sch', 'facebook', 'google'
    ];

    return [
        'provider'      => $providers[random_int(0, count($providers) - 1)],
        'provider_id'   => str_random(),
        'access_token'  => str_random(),
        'refresh_token' => str_random()
    ];
});
