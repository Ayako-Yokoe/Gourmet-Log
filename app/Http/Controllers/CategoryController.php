<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{    
    // Show create form and list of all categories
    public function index(){

        $isEditing = false;
        //$editingCategoryId = null;
        $categories = Category::paginate(10);

        return view('categories.index', [
            'categories' => $categories, 
            'isEditing' => $isEditing,
            //'editingCategoryId'=> $editingCategoryId
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
        //$editingCategoryId = $request->input('editingCategoryId');
        $categories = Category::paginate(10);
        $category = Category::findOrFail($id);

        return view('categories.index', [ 
            'isEditing' => $isEditing,
            'categories' => $categories,
            'category' => $category,
            //'editingCategoryId' => $editingCategoryId
        ]);
    }

    // Update category
    public function update(Request $request, $id){
        //$isEditing = false;

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
