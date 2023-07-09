<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $categories = Category::all();

        return view('restaurants.create', ['categories' => $categories]);
    }


    // Pass input data to confirmation page
    public function confirm(Request $request){

        $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            // 'phone_number' => 'integer',
            'comment' => ['required', 'max:300'],
            'food_picture' => ['nullable', 'image']
        ]);

        // Category ID
        $categories = $request->input('categories', []);  // [1, 2, 3]
        // $categoryString = implode(',', $categories);

        // Category Value
        // $categories = Category::whereIn('id', explode(',', $categoryString))->get();
        $findcategories = Category::whereIn('id', $categories)->get();
        $categoryValues = $findcategories->pluck('name'); 
            //     items: array:3 [▶
            //     0 => "日本料理"
            //     1 => "インド料理"
            //     2 => "韓国料理"
            //   ]

        // Map URL
        $iframeCode = $request->input('map_url');
        preg_match('/src="([^"]+)"/', $iframeCode, $matches);
        $srcPart = count($matches) > 1 ? $matches[1] : $iframeCode;

        // Upload food image
        if($request->hasFile('food_picture')){
            $photo = $request->file('food_picture');
            $photoPath = $photo->store('photos', 'public');
            $photoUrl = Storage::disk('public')->url($photoPath);
        } else {
            $photoUrl = null;
        }


        $formFields = $request->all();
        //$formFields['categories'] = $categoryString;
        $formFields['map_url'] = $srcPart;
        $formFields['food_picture'] = $photoUrl;
        $formFields['id'] = $request->input('restaurant_id');

        return view('restaurants.confirm', [
            'inputs' => $formFields,
            'categoryValues' => $categoryValues
        ]);
    }



    // Store new restaurant data
    public function store(Request $request){

        // Remove hyphens from phone number
        $phoneNumber = str_replace('-', '', $request->input('phone_number'));
        $phoneNumberAsInteger = (int) $phoneNumber;


        $validatedData = $request->validate([
            'name' => ['required', 'max:20', 'string'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'categories' => ['required'],
            'categories.*' => ['exists:categories,id'],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            // 'phone_number' => 'integer',
            $phoneNumberAsInteger => 'integer',
            'comment' => ['required', 'max:300'],
            'food_picture' => ['nullable', 'url']
        ]);


        $action = $request->input('action');
        $formFields = $request->except('action');


        // Upload food image
        if($request->hasFile('food_picture')){
            $photo = $request->file('food_picture');
            $photoPath = $photo->store('photos', 'public');
            $photoUrl = Storage::disk('public')->url($photoPath);
        } else {
            $photoUrl = null;
        }

        // Convert categories to an array
        $categoriesArray = $request->input('categories', []);

        //$formFields['phone_number'] = $phoneNumberAsInteger;

        if($action === 'submit'){

            // Once handling the user_id, change this.
            // Use updateOrCreate

            // Update or create new restaurant data
            $restaurantId = $request->input('id');
            $existingRestaurant = Restaurant::find($restaurantId);

            if($existingRestaurant){          
                // Update the existing restaurant
                $restaurant = Restaurant::find($restaurantId);

                // categoriesArray in nor stored if using $validatedData
                $restaurant->update($validatedData);

            } else {
                // Change this. "nullable is not working"
                $formFields['user_id'] = 0;
                $formFields['food_picture'] = $photoUrl;
                $formFields['phone_number'] = $phoneNumberAsInteger;
                $formFields['categories'] = $categoriesArray;

                // Create a new restaurant
                // Restaurant::create($formFields);  
                $newRestaurant = Restaurant::create($formFields); 

                // Category_Tag
                $restaurant = Restaurant::find($newRestaurant->id);
                $restaurant->categories()->sync($categoriesArray);

            }   

            return redirect()->route('restaurants.index'); 

        } else {
            // Return to the create page with input
            $phoneNumber = formatPhoneNumber($phoneNumberAsInteger);
            $formFields['phone_number'] = $phoneNumber;

            $formFields['food_photo'] = $photoUrl;

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