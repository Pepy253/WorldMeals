<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    public function meals()
    {
       return $this->belongsToMany(Meal::class, 'meal_tags');
    }

    public function languages()
    {
       return $this->belongsToMany(Languages::class, 'tag_translations');
    }
}
