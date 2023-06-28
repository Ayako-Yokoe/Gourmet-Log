<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    // Show all restaurants
    public function index(){
        $restaurants = Restaurant::all();
        return view('restaurants.index', ['restaurants' => $restaurants]);
    }

    // Show single restaurant
    public function show($id){
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', ['restaurant' => $restaurant]);
    }

    // Show create form
    public function create(){
        return view('restaurants.create');
    }

    // Pass input data to confirmation page
    public function confirm(Request $request){

        // 'category' => ['required_without_all:' . implode(',', $dynamicCategories)],

        // Hard-coded for now
        $dynamicCategories = ['category1', 'category2', 'category3'];

        $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'categories' => ['required', 'array', 'required_without_all:' . implode(',', $dynamicCategories)],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            'phone_number' => 'integer',
            'comment' => ['required', 'max:300'],
            'food_picture' => ['nullable', 'image']
        ]);

        $categories = $request->input('categories', []);
        $categoryString = implode(',', $categories);

        $formFields = $request->all();
        $formFields['categories'] = $categoryString;

        return view('restaurants.confirm', [
            'inputs' => $formFields
        ]);
    }


    // Handle category later
    // Store new restaurant data
    public function store(Request $request){

        // 'category' => ['required_without_all:' . implode(',', $dynamicCategories)],

        // Hard-coded for now
        // $dynamicCategories = ['category1', 'category2', 'category3'];

        // $categories = $request->input('categories', []);
        // $categoryString = implode(',', $categories);

        // $request->merge([
        //     'categories' => $categoryString
        // ]);

        $validatedData = $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            // 'categories' => ['required', 'array', 'required_without_all:' . implode(',', $dynamicCategories)],
            //'categories' => ['required', 'array'],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            'phone_number' => 'integer',
            'comment' => ['required', 'max:300'],
            //'food_picture' => ['nullable', 'image']
        ]);

        $action = $request->input('action');
        $formFields = $request->except('action');

        
        if($action === 'submit'){

            $formFields['user_id'] = 7;
            $formFields['food_picture'] = "https://via.placeholder.com/150x150.png/003399?text=food+et";

            Restaurant::create($formFields);
            return redirect()->route('restaurants.index');            
        } 

        return redirect()->route('restaurants.create')->withInput($formFields);
    }








    // Show edit form
    public function edit(Restaurant $restaurant){
        return view('restaurant.edit', ['restaurant' => $restaurant]);
    }


    // Update restaurant data
    public function update(Request $request, Restaurant $restaurant){
        $formFields = $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            // 'category' =>   ,
            'review' => ['required', 'integer', 'min:1', 'max:5'],
            'phone_number' => 'integer',
            'comment' => ['required', 'max:300']
        ]);

        $restaurant->update($formFields);

        return back();
    }

    // Delete restaurant
    public function destroy(Restaurant $restaurant){
        $restaurant->delete();

        return redirect('/');
    }
}