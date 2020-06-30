<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Meal');
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        $categories = DB::table('categories')->get();
        
        for($i = 0; $i < 35; $i++)
        {
            $name[] = $faker->foodName();
        }

        $food = array_unique($name);

        foreach($food as $data)
        {
            $rnd = rand(0, 100);

            if($rnd < 60)
            {
                $catId = rand($categories[0]->id, $categories[(count($categories)-1)]->id);
            }
            else
            {
                $catId = null;    
            }

            DB::table('meals')->insert([
                'category_id' => $catId,
                'slug' => Str::slug($data, '_'),
                'title' => $data,
                'description' => $faker->realText($maxNbChars = 50, $index = 2),
                'created_at' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
            ]);
        }
    }
}
