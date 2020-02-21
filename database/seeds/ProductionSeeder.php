<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Faker\UniqueGenerator as UniqueFaker;

class ProductionSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // stock management module
        factory(App\Category::class, 20)->create()->each(function ($category) use ($faker) {
            $category->products()->createMany(
                factory(App\Product::class, $faker->numberBetween(5, 10))->make()->toArray()
            );
        });

        $this->call([
            CommandsTableSeeder::class,
        ]);

        // employee management module
        factory(App\Department::class, 10)->create()->each(function ($department) use ($faker) {
            $posts = $department->posts()->createMany(
                factory(App\Post::class, $faker->numberBetween(8, 12))->make()->toArray()
            );

            $posts->each(function ($post) use ($faker) {
                $worker = factory(App\Worker::class)->make(['post_id' => $post->id]);
                $post->worker()->save($worker);
                $worker->dues()->createMany(
                    factory(App\Due::class, $faker->numberBetween(1, 3))->make([
                        'amount' => $worker->salary
                    ])->toArray()
                );
            });
        });


        // accounting module
        factory(App\FlowCategory::class, 6)->create()->each(function ($flowcategory) use ($faker) {
            $flows = factory(App\Flow::class, 3)->make();

            $flows =  $flows->map(function ($flow) use ($flowcategory) {
                $faker = new Faker;
                $faker->addProvider(new \App\Faker\CustomProvider($faker));

                $data = $faker->unique()->enterpriseFlow(key_exists($flowcategory->name, $faker->flows["in"]) ? "in" : "out", null, $flowcategory->name);
                $flow->name = $data['name'];
                $flow->frequency = $data['frequency'];
                return $flow;
            });

            $flowcategory->flows()->createMany(
                $flows->toArray()
            )->each(function ($flow) use ($faker) {
                $flow->dues()->createMany(
                    factory(App\Due::class, $flow->frequency ?  $faker->numberBetween(1, 3) : 1)->make($flow->amount !== null ? ['amount' => $flow->amount] : [])->toArray()
                );
            });
        });

        //create admin worker

        App\Worker::updateOrCreate(
            ["name" => "admin"],
            [
                "email" => "admin@email.com",
                "gender" => "Male",
                "username" => "admin",
                "address" => "admin",
                "password" => bcrypt('admin'),
                "post_id" => factory(App\Post::class)->create()->id
            ]
        );
    }
}
