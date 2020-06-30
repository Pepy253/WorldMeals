<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model 
{

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredients');

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tags');
    }

    public function languages()
    {
        return $this->belongsToMany(Meal::class, 'meal_translations')->withPivot('title', 'decription');
    }

}
