<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FlowCategory;
use Faker\Generator as Faker;

$factory->define(FlowCategory::class, function (Faker $faker) {
    $faker->addProvider(new \App\Faker\CustomProvider($faker));
    return [
        'name' => $faker->unique()->enterpriseFlowCategoryName,
        'desc' => $faker->sentences(3,  true),
    ];
});
