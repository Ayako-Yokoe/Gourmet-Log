<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    // Show all restaurants
    public function index(Request $request){

        if($request->filled('search')){
            $search = $request->input('search');

            // print_r($search);

            $restaurants = Restaurant::where('name', 'LIKE', "%{$search}%")
            ->orWhere('name_katakana', 'LIKE', "%{$search}%")
            ->orWhere('comment', 'LIKE', "%{$search}%")
            ->paginate(10);

        } else {
            $restaurants = Restaurant::paginate(10);
        }

        // Format phone number
        foreach ($restaurants as $restaurant){
            $phoneNumber = formatPhoneNumber($restaurant->phone_number);
            $restaurant->phone_number = $phoneNumber;
        }

        return view('restaurants.index', ['restaurants' => $restaurants]);
    }

    // Show single restaurant
    public function show($id){
        $restaurant = Restaurant::findOrFail($id);
        $phoneNumber = formatPhoneNumber($restaurant['phone_number']);
        $restaurant['phone_number'] = $phoneNumber;
        
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
            // 'phone_number' => 'integer',
            'comment' => ['required', 'max:300'],
            'food_picture' => ['nullable', 'image']
        ]);

        $categories = $request->input('categories', []);
        $categoryString = implode(',', $categories);

        $formFields = $request->all();
        $formFields['categories'] = $categoryString;

        $formFields['id'] = $request->input('restaurant_id');

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

        // Remove hyphens from phone number
        $phoneNumber = str_replace('-', '', $request->input('phone_number'));
        $phoneNumberAsInteger = (int) $phoneNumber;

        $validatedData = $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            // 'categories' => ['required', 'array', 'required_without_all:' . implode(',', $dynamicCategories)],
            //'categories' => ['required', 'array'],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            // 'phone_number' => 'integer',
            $phoneNumberAsInteger => 'integer',
            'comment' => ['required', 'max:300'],
            //'food_picture' => ['nullable', 'image']
        ]);


        $action = $request->input('action');
        $formFields = $request->except('action');

        //$formFields['phone_number'] = $phoneNumberAsInteger;

        if($action === 'submit'){
            // Update or create new restaurant data
            $restaurantId = $request->input('id');
            $existingRestaurant = Restaurant::find($restaurantId);

            if($existingRestaurant){          
                // Update the existing restaurant
                $restaurant = Restaurant::find($restaurantId);
                $restaurant->update($validatedData);

            } else {
                // Change this "nullable is not working"
                $formFields['user_id'] = 0;
                $formFields['food_picture'] = "https://via.placeholder.com/150x150.png/003399?text=food+et";
                $formFields['map_url'] = "http://schimmel.com/";
                $formFields['phone_number'] = $phoneNumberAsInteger;

                // Create a new restaurant
                Restaurant::create($formFields);  
            }   

            return redirect()->route('restaurants.index'); 

        } else {
            // Return to the create page with input
            $phoneNumber = formatPhoneNumber($phoneNumberAsInteger);
            $formFields['phone_number'] = $phoneNumber;

            return redirect()->route('restaurants.create')->withInput($formFields);
        }
    }

    // Show edit form
    public function edit($id){

        $restaurant = Restaurant::findOrFail($id);

        $phoneNumber = formatPhoneNumber($restaurant['phone_number']);
        $restaurant['phone_number'] = $phoneNumber;

        return view('restaurants.create', ['restaurant' => $restaurant]);
    }

    // Delete restaurant
    public function destroy($id){

        $restaurant = Restaurant::findOrFail($id);
        if($restaurant){
            $restaurant->delete();
        }
        
        return redirect()->route('restaurants.index');
    }
}