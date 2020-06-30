<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Meal;
use App\Category;
use App\Tag;
use App\Ingredient;
use App\Language;

class FilterController extends Controller
{
    public function getFilters()
    {
        $languages = Language::all();

        return view('filter')->with('languages', $languages);
    }

    public function filter(Request $request)
    {
        $data = $request->all();

        $customMessages = array(
            'perPage.min' => 'Meals shown per page cannot be less than 1!',
            'perPage.max' => 'Meals shown per page cannot be more than 200!',
            'perPage.numeric' => 'Per page can only be a numerical value!',
            'lang.in' => 'Specified language is not supported! Supported languages are English, French and German!',
        );


        $validator = Validator::make($data, [
            'perPage' => 'min:1|max:200|numeric',
            'lang' => 'nullable|exists:languages,slug',
            ], $customMessages);

        if($validator->fails())
        {
            return view('meals')->withErrors($validator)->with('meals', $meals);
        }
        else
        {
            $lang = $data['lang'];
            $perPage = $data['perPage'];

            return redirect()->route('meals.show', ['per_page' => $perPage, 'lang' => $lang]);
        }
    }
}
