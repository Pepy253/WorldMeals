<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create('App\Tag');

        $tags = array('Fruity', 'Sweet', 'Sour', 'Spicy');

        foreach($tags as $tag)
        {
            DB::table('tags')->insert([
                'title' => $tag,
                'slug' => Str::slug($tag, '_'),
                'created_at' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null)
            ]);
        }
    }
}
