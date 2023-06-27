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


    // Handle category later

    // Store new restaurant data
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            // 'category' =>   ,
            'review' => ['required', 'integer', 'min:1', 'max:5'],
            'phone_number' => 'integer',
            'comment' => ['required', 'max:300']
        ]);

        Restaurant::create($formFields);

        return redirect('/');
    }

    // Show confirmation page ?


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