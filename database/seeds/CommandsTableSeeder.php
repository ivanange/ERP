<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CommandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        factory(App\Command::class, 80)->create()->each(function ($command) use ($faker) {

            $selected = $faker->randomElements(
                App\Product::where('qte', '>', 0)->orderBy(
                    $faker->randomElement(['price', 'weight', 'name', 'manufacturer'])
                )->limit(20)->get(),
                $faker->numberBetween(1, 10)
            );
            $attach = [];
            foreach ($selected as  $product) {
                $qte = $faker->numberBetween(1, (int) ($product->qte / 2));
                $attach[$product->id] = ['qte' => $qte];
                $product->qte -= $qte;
                $product->save();
            }

            $command->products()->attach($attach);
        });
    }
}
