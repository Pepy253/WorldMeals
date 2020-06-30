<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model 
{
    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_ingredients');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'ingredient_translations')->withPivot('title');
    }
}
