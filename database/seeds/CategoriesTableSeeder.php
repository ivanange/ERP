<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(App\Category::class, 20)->create()->each(function ($category)  use ($faker) {
            $category->products()->createMany(
                factory(App\Product::class, $faker->numberBetween(5, 20))->make()->toArray()
            );
        });
    }
}
