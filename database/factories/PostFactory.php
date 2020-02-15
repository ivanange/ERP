<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new \App\Faker\CustomProvider($faker));
    return [
        'name' => $faker->unique()->enterpriseJobTitle(),
        'desc' => $faker->sentences(3,  true),
        'baseSalary' => $faker->randomFloat(4, 100000, 2500000)
    ];
});

$factory->state(App\Post::class, 'relate', function ($faker) {
    return [
        'department_id' => function () {
            return factory(App\Department::class)->create()->id;
        }
    ];
});
