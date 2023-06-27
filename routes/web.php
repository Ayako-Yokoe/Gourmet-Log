<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('components.layout');
});


// Restaurants
// Show all restaurants
 Route::get('/restaurants', [RestaurantController::class, 'index']);

// Show create form -- order matters
Route::get('/restaurants/create', [RestaurantController::class, 'create']);

// Show single restaurant
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
    
// Store new restaurant data
Route::post('/restaurants', [RestaurantController::class, 'store']);
    
// Show confirmation page ?


// Show edit form
Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit']);
    
// Update restaurant data
Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    
// Delete restaurant
Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);
    


