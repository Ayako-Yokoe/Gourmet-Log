<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{    
    // Show create form and list of all categories
    public function index(){
        $isEditing = false;
        //$categories = Category::paginate(10);

        $perPage = 10;
        $categories = Category::paginate($perPage);

        // Display Pages
        $from = $categories->firstItem();
        $to = $categories->lastItem();
        $total = $categories->total();


        return view('categories.index', [
            'categories' => $categories, 
            'isEditing' => $isEditing,
            'from' => $from,
            'to' => $to,
            'total' => $total
        ]);
    }

    // Store newly created category
    public function store(Request $request){
        $formField = $request->validate([
            'name' => ['required', 'string', 'max:10']
        ]);

        Category::create($formField);

        return redirect()->route('categories.index', ['refresh' => 1]);
    }


    // Show edit form
    public function edit(Request $request, $id){
        $isEditing = true;
        $editingCategoryId = $id;
        $categories = Category::paginate(10);
        $category = Category::findOrFail($id);

        return view('categories.index', [ 
            'isEditing' => $isEditing,
            'categories' => $categories,
            'category' => $category,
            'editingCategoryId' => $editingCategoryId
        ]);
    }

    // Update category
    public function update(Request $request, $id){
        $formField = $request->validate([
            'name' => ['required', 'string', 'max:10']
        ]);

        $category = Category::find($id);
        $category->update($formField);

        return redirect()->route('categories.index');
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
