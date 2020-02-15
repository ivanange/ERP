<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Command;
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

$factory->define(Command::class, function (Faker $faker) {
    $statuses = [Command::LIVRER, Command::ANNULER, Command::ENCOURS,];
    $issueDate = $faker->dateTimeThisMonth('now', 'utc');
    $status = $faker->randomElement($statuses);
    array_pop($statuses);
    return [
        'name' => $faker->boolean(40) ? $faker->name :  null,
        'issueDate' => $issueDate,
        'deliveryDate' => in_array($status, $statuses) ? $faker->dateTimeBetween($issueDate, "+1 month", 'utc') : null,
        'status' => $status,
    ];
});
