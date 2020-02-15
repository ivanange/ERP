<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    $faker->addProvider(new \App\Faker\CustomProvider($faker));
    return [
        'name' => $faker->unique()->enterpriseDepartmentName,
        'desc' => $faker->sentence,
    ];
});
