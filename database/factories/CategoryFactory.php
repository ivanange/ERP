<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(Category::class, function (Faker $faker) {
    return [
        "name" => rtrim($faker->text($faker->numberBetween(10, 30)), "."),
        "desc" => $faker->boolean(70) ? $faker->sentence : null,
    ];
});
