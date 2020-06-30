<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Language');
        $categories = array('Appetizer', 'Soup', 'Sauce', 'Salad', 'Main course', 'Dessert'); 
        
        foreach($categories as $category)
        {
            DB::table('categories')->insert([
                'title' => $category,
                'slug' => Str::slug($category, '_'),
                'created_at' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
            ]);
        }
    }
}
