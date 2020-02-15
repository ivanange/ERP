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
    //$faker = \Faker\Factory::create();
    $faker->addProvider(new Bezhanov\Faker\Provider\Commerce($faker));
    return  [
        "name" => $faker->productName,
        "manufacturer" => $faker->company,
        //"image" => $faker->optional(0.2, null)->image('public/storage/images', 640, 480, null, false),
        "weight" => $faker->randomFloat(2, 200, 1000),
        "price" => $faker->randomFloat(2, 50, 15000),
        "qte" => $faker->numberBetween(5, 30),
        "expireDate" => $faker->boolean(70) ?
            $faker->dateTimeBetween(
                $faker->randomElement(['now', '-1 month']),
                $faker->randomElement(['+5 months', 'now', '+1 month']),
                'utc'
            ) : null,
    ];
});

$factory->state(App\Product::class, 'relate', function ($faker) {
    return [
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        }
    ];
});
