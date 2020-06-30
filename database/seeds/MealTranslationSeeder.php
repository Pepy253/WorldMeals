<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;

class MealTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\MealTranslation');
        $meals = DB::table('meals')->get();
        $languages = DB::table('languages')->where('slug', '!=', 'en')->get();

        
        for($i = 0; $i < count($meals); $i++)
        {
            for($j = 0; $j < count($languages); $j++)
            {
                DB::table('meal_translations')->insert([
                    'meal_id' => $meals[$i]->id,
                    'language_id' => $languages[$j]->id,
                    'title' => GoogleTranslate::trans($meals[$i]->title, $languages[$j]->slug),
                    'description' => GoogleTranslate::trans($meals[$i]->description, $languages[$j]->slug)
                ]);
            }
        }
    }
}
