<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;

class IngredientTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create('App\IngredientTranslation');
        $ingredients = DB::table('ingredients')->get();
        $languages = DB::table('languages')->where('slug', '!=', 'en')->get();

        foreach($ingredients as $ingredient)
        {
            for($i = 0; $i < count($languages); $i++)
            {
                DB::table('ingredient_translations')->insert([
                    'ingredient_id' => $ingredient->id,
                    'language_id' => $languages[$i]->id,
                    'title' => GoogleTranslate::trans($ingredient->title, $languages[$i]->slug)
                ]);
            }
        }
    }
}
