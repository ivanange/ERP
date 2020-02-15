<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flow;
use Faker\Generator as Faker;

$factory->define(Flow::class, function (Faker $faker) {
    $faker->addProvider(new \App\Faker\CustomProvider($faker));
    $type = $faker->boolean(85) ? 2 : 1;
    $flow = $faker->unique()->enterpriseFlow($type === 1 ? "in" : "out");
    return [
        'type' => $type,
        'name' => $flow["name"],
        'desc' => $faker->sentence,
        'amount' => $faker->optional(0.6)->randomFloat(2, 30000, 150000),
        "frequency" => $flow["frequency"] //strtotime format e.g '+ 1 days 4 months 2 weeks'
    ];
});
