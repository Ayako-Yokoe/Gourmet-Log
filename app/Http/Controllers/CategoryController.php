<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show create form and list of all categories
    public function index(){
        $categories = Category::paginate(10);
        return view('categories.index', ['categories' => $categories]);
    }

    // Store newly created category
    public function store(Request $request){

        $formField = $request->validate([
            'name' => ['required', 'string', 'max:10']
        ]);

        Category::create($formField);

        return redirect()->route('categories.index', ['refresh' => 1]);
    }



    // Delete category
    public function destroy($id){
        $category = Category::findOrFail($id);

        if($category){
            $category->delete();
        }

        return redirect()->route('categories.index');
    }
}
