<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //WorkersTableSeeder::class,
            //CategoriesTableSeeder::class,
            //CommandsTableSeeder::class,
            //ProductsTableSeeder::class,
            ProductionSeeder::class
        ]);
    }
}
