<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
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

// Landing Page
Route::get('/', fn () => view('landing'))->name('landing');

// Dashboard
Route::get('/dashboard', function () {
    $userName = Auth::user()->name;
    return view('dashboard', ['userName' => $userName]);
})->name('dashboard')->middleware('auth');


// Restaurants
// Show all restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index')->middleware('auth');

 // Store new restaurant data
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store')->middleware('auth');

// Show create form -- order matters
Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create')->middleware('auth');

// Show confirmation page
Route::post('restaurants/confirm', [RestaurantController::class, 'confirm'])->name('restaurants.confirm')->middleware('auth');

// Edit before confirmation or store newly created restaurant
Route::post('/restaurants/store', [RestaurantController::class, 'store'])->name('restaurants.store')->middleware('auth');

// Show single restaurant
Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->middleware('auth');

// Show edit form
Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit')->middleware('auth');

// Update restaurant data
Route::put('/restaurants/{id}', [RestaurantController::class, 'update'])->middleware('auth');

// Delete restaurant
Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy'])->middleware('auth');
    



// Categories
// Show create form and list of all categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');

// Store newly created category
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');


// Show edit form
Route::post('/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware('auth');

// Update category
Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('auth');

// Delete category
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('auth');




// Register/Login
// Show Register Form
Route::get('/register', [UserController::class, 'create']);

// Create New User
Route::post('/users', [UserController::class, 'store'])->name('users');

// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login');

// Login User
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');
