<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class RestaurantController extends Controller

{
    // Show all restaurants
    public function index(Request $request){
        $user = Auth::user();
        $restaurantsQuery = Restaurant::where('user_id', $user->id)->orderBy('id', 'asc');

        if($request->filled('search')){
            $search = $request->input('search');

            $restaurantsQuery->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('name_katakana', 'LIKE', "%{$search}%")
                ->orWhere('comment', 'LIKE', "%{$search}%");
            });
        }
            
        $perPage = 10;
        $restaurants = $restaurantsQuery->paginate($perPage);

        // Format phone number
        foreach ($restaurants as $restaurant){
            $phoneNumber = $this->formatPhoneNumber($restaurant->phone_number);
            $restaurant->phone_number = $phoneNumber;
        }

        // Display Pages
        $from = $restaurants->firstItem();
        $to = $restaurants->lastItem();
        $total = $restaurants->total();

        return view('restaurants.index', compact('restaurants', 'from', 'to', 'total'));
    }

    // Show single restaurant
    public function show($id){
        $user = Auth::user();
        $restaurant = $user->restaurants()->findOrFail($id);

        $phoneNumber = $this->formatPhoneNumber($restaurant['phone_number']);
        $restaurant['phone_number'] = $phoneNumber;

        // Categories
        $categories = $restaurant->categories;
        
        return view('restaurants.show', compact('restaurant', 'categories'));
    }

    // Show create form
    public function create(){
        $categories = Category::all();

        return view('restaurants.create', compact('categories'));
    }

    // Pass input data to confirmation page
    public function confirm(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'categories' => ['required', 'array', 'checkbox_values'],
            'categories.*' => ['exists:categories,id'],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            'comment' => ['required', 'max:300'],
            'food_picture' => ['nullable', 'image']
        ]);

        $validatedData = $validator->validated();

        // Category ID
        $categories = $request->input('categories', []);

        // Category Value
        $findcategories = Category::whereIn('id', $categories)->get();
        $categoryValues = $findcategories->pluck('name'); 

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

        $mapUrl = $srcPart;
        $foodPicture = $photoUrl;
        $id = $request->input('restaurant_id');
        $phoneNumber = $request->has('phone_number') ? $request->input('phone_number') : null;

        $formFields = array_merge($validatedData, [
            'map_url' => $mapUrl,
            'food_picture' => $foodPicture,
            'id' => $id,
            'phone_number' => $phoneNumber
        ]);

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
            'name' => ['required', 'string', 'max:20'],
            'name_katakana' => ['required', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'categories' => ['required', 'array', 'checkbox_values'],
            'categories.*' => ['exists:categories,id'],
            'review' => ['required', 'numeric', 'min:1', 'max:5'],
            $phoneNumberAsInteger => 'integer',
            'comment' => ['required', 'max:300'],
            'food_picture' => ['nullable', 'url'],
            'map_url' => ['nullable']
        ]);

        $action = $request->input('action');

        // Convert categories to an array
        $categoriesArray = $request->input('categories', []);
        
        // Store data or edit data
        if($action === 'submit'){
            // Update or create new restaurant data
            $restaurant = Restaurant::updateOrCreate(
                ['id' => $request->input('id')],
                [                    
                    'user_id' => Auth::user()->id,
                    'name' => $validatedData['name'],
                    'name_katakana' => $validatedData['name_katakana'],
                    'review' => $validatedData['review'],
                    'phone_number' => $phoneNumberAsInteger,
                    'comment' => $validatedData['comment'],
                    'food_picture' => $request->input('food_picture') ?: null,
                    'map_url' => $request->input('map_url') ?: null,
                ]
                );

            $restaurant->categories()->sync($categoriesArray);

            return redirect()->route('restaurants.index'); 

        } else {
            // Return to the create page with input
            $phoneNumber = $this->formatPhoneNumber($phoneNumberAsInteger);
            $formFields['phone_number'] = $phoneNumber;

            // Retrieve category IDs from the input
            $selectedCategoryIds = $request->input('categories', []);

            // Al categories
            $categories = Category::all();

            return redirect()->route("restaurants.create")->withInput();
        }
    }

    // Show edit form
    public function edit($id){
        $user = Auth::user();
        $restaurant = $user->restaurants()->findOrFail($id);

        $phoneNumber = $this->formatPhoneNumber($restaurant['phone_number']);
        $restaurant['phone_number'] = $phoneNumber;

        // All categories
        $categories = Category::all();
        // Selected category IDs
        $selectedCategoryIds = $restaurant->categories->pluck('id')->toArray();

        return view('restaurants.create', compact('restaurant', 'categories', 'selectedCategoryIds'));
    }

    // Delete restaurant
    public function destroy($id){
        $user = Auth::user();
        $restaurant = $user->restaurants()->findOrFail($id);

        if($restaurant){
            $restaurant->delete();
        }
        
        return redirect()->route('restaurants.index');
    }

    // Helper functions
    private function formatPhoneNumber($phoneNumber){
        if($phoneNumber){
            $formattedPhoneNumber = substr($phoneNumber, 0, 3) . '-' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6, 4);
            return $formattedPhoneNumber;
        }
        return '';
    }
}
