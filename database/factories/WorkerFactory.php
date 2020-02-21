<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Worker;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\Query\Expression;

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

$factory->define(Worker::class, function (Faker $faker) {
    $gender = $faker->randomElement(['Male', 'Female']);
    return [
        'name' => $faker->firstName($gender),
        'surname' => $faker->lastName($gender),
        'telephone' => $faker->optional(0.1)->phoneNumber,
        'birthdate' => $faker->optional(0.1)->date,
        'email' => $faker->optional(0.3)->safeEmail,
        'title' => $faker->title($gender),
        'gender' => $gender,
        'address' => $faker->address,
        'permissions' => 2 ** $faker->numberBetween(0, 10),
        'username' => $faker->unique()->userName,
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(10),
        'extraHours' => $faker->numberBetween(0, 40),
    ];
});


$factory->state(App\Worker::class, 'relate', function ($faker) {
    return [
        'post_id' => function () {
            return factory(App\Post::class)->create()->id;
        }
    ];
});
