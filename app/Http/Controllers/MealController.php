<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Meal;
use App\Category;
use App\Tag;
use App\Ingredient;
use App\Language;

class MealController extends Controller
{
    public function show(Request $request)
    {   
        $input = $request->all();
       
        $customMessages = array(
            'per_page.min' => 'Meals shown per page cannot be less than 1!',
            'per_page.max' => 'Meals shown per page cannot be more than 200!',
            'per_page.numeric' => 'Per page can only be a numerical value!',
            'lang.exists' => 'Specified language is not supported! Supported languages are English, French and German!',
        );

        $rules = array(
            'per_page' => 'min:1|max:200|numeric',
            'lang' => 'exists:languages,slug',
        );

        $validator = Validator::make($input, $rules, $customMessages);

        if($validator->fails())
        {   
            $meals = Meal::with('category', 'tags', 'ingredients')->get();
            return view('meals')->withErrors($validator)->with('meals', $meals);
        }
        else
        {     
            $lang = $input['lang'] ?? 'en';
            $perPage = $input['per_page'] ?? 5;  
            
            if($lang == 'en')
            {              
                $meals = Meal::with('category', 'tags', 'ingredients')->paginate($perPage);

                return view('meals', ['meals' => $meals]);
            }
            elseif($lang == 'de' || $lang == 'fr')
            {
                $language = Language::select('id')->where('slug', '=', $lang)->get()->toArray();

                $meals = Meal::with('category', 'tags', 'ingredients')
                            ->join('meal_translations as mt', 'mt.meal_id', '=', 'id')
                            ->where('mt.language_id', $language[0]['id'])
                            ->paginate($perPage);
                $ingredients = Ingredient::select('id as iId', 'it.title as iTitle')
                            ->join('ingredient_translations as it', 'it.ingredient_id', '=', 'id')
                            ->where('it.language_id', $language[0]['id'])
                            ->get();
                $tags = Tag::select('id as tId', 'tt.title as tTitle')
                            ->join('tag_translations as tt', 'tt.tag_id', '=', 'id')
                            ->where('tt.language_id', $language[0]['id'])
                            ->get();
                $categories = Category::select('id as cId', 'ct.title as cTitle')
                            ->join('category_translations as ct', 'ct.category_id', '=', 'id')
                            ->where('ct.language_id', $language[0]['id'])
                            ->get();

                            
                return view('meals')->with(['meals' => $meals, 'ingredients' => $ingredients, 'tags' => $tags, 'categories' => $categories, 'lang' => $lang]);
            }
        }
    }
}
