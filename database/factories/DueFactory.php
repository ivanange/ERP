<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Due;
use Faker\Generator as Faker;

$factory->define(Due::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 30000, 150000),
        'created_at' => $faker->dateTimeBetween('-1 month', '+5 months', 'utc'),
    ];
});
