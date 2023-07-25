<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{    
    // Show create form and list of all categories
    public function index(){
        $isEditing = false;

        $perPage = 10;
        $categories = Category::paginate($perPage);
        list($from, $to, $total) = $this->getPaginationDetails($categories);

        return view('categories.index', compact('categories', 'isEditing', 'from', 'to', 'total'));
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
        
        $perPage = 10;
        $categories = Category::paginate($perPage);
        $category = Category::findOrFail($id);
        list($from, $to, $total) = $this->getPaginationDetails($categories);

        return view('categories.index', compact('isEditing', 'categories', 'category', 'editingCategoryId', 'from', 'to', 'total'));
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

    // Helper functions
    private function getPaginationDetails($categories){
        $from = $categories->firstItem();
        $to = $categories->lastItem();
        $total = $categories->total();

        return [$from, $to, $total];
    }

}
