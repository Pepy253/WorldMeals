<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = DB::table('languages')->where('slug', '!=', 'en')->get();
        $categories = DB::table('categories')->get();
        $translations = array(
            array('Apéritif', 'Vorspeise'),
            array('Soupe', 'Suppe'),
            array('Sauce', 'Soße'),
            array('Salade', 'Salat'),
            array('Plat principal', 'Hauptkurs'),
            array('Dessert', 'Dessert'),      
        );

        for($i = 0; $i < count($categories); $i++)
        {
            for($j = 0; $j < count($languages); $j++)
            {
                DB::table('category_translations')->insert([
                    'category_id' => $categories[$i]->id,
                    'language_id' => $languages[$j]->id,
                    'title' => $translations[$i][$j]
                ]);                
            }
        }
    }
}
