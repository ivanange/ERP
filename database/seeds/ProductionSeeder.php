<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductionSeeder extends Seeder
{

    public $categories = [
        "Antibiotic / Antibactériens ",
        "Calmants / Antidouleur / Anesthésique",
        "Vaccins / Antiviraux",
        "Anti-Paludéen / Fiévre",
        "Tranquillisants / Anti-Depresseurs / Somnifaire",
        "Antipyrétiques",
        "Antiseptiques / Déinfectants",
        "Stimulants ",
        "Contraceptifs oraux",
        "Antifongique",
        "Anticholinergiques",
        "Vitamines / Anabolisants",
        "Analgésiques et Anti-inflammatoires",
        "Antituberculeux et Antilépreux",
        "Cancérologique et hématologique ",
        "Antigoutteux",
        "Antiallergiques / Antianaphylactiques",
        "Antidotes",
        "Anticonvulsants / Antiepileptiques",
        " Inhibiteurs nucléosidiques/nucléotidiques"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        foreach ($this->categories as $name) {
            $category = factory(App\Category::class)->create(["name" => $name]);
            $category->products()->createMany(
                factory(App\Product::class, $faker->numberBetween(5, 15))->make()->toArray()
            );
        }

        $this->call([
            CommandsTableSeeder::class,
        ]);
        /*

        factory(App\User::class, 10)->create([
            "name" => "admin",
            "email" => "admin@email.com",
            "password" => bcrypt('admin')
        ]);
 */
    }
}
