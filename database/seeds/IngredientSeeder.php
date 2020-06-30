<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;



class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create('App\Ingredient');
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        for($i = 0; $i < 10; $i++)
        {
        $name[] = $faker->vegetableName();
        }

        $ingredients = array_unique($name);

        foreach($ingredients as $ingredient)
        {
            DB::table('ingredients')->insert([
                'title' => $ingredient,
                'slug' => Str::slug($ingredient, '_'),
                'created_at' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
            ]);
        }
    }
}
