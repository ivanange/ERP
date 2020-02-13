<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
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

$factory->define(Product::class, function (Faker $faker) {
    $faker = \Faker\Factory::create();
    $faker->addProvider(new \Bezhanov\Faker\Provider\Medicine($faker));
    return  [
        "name" => $faker->medicine,
        "manufacturer" => $faker->company,
        //"image" => $faker->boolean ? $faker->image('public/storage/images', 640, 480, null, false) : null,
        "weight" => $faker->randomFloat(2, 200, 1000),
        "price" => $faker->randomFloat(2, 1, 10000),
        "qte" => $faker->numberBetween(5, 60),
        "expireDate" => $faker->dateTimeBetween(
            $faker->randomElement(['now', '-1 month']),
            $faker->randomElement(['+5 monthsr', 'now', '+1 month']),
            'utc'
        ),
    ];
});

$factory->state(App\User::class, 'relate', function ($faker) {
    return [
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        }
    ];
});
