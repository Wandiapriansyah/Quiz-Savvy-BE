<?php

namespace App\Http\Controllers;

use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;

class Category extends Controller
{
    public function index(){
        $categories = ModelsCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|string|unique:categories,category_name|max:255',
        ]);

        $category = ModelsCategory::create([
            'category_name' => $request->category_name,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category,
        ], 201);
    }

    public function show($id){
        $category = ModelsCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required|string|unique:categories,category_name|max:255',
        ]);

        $category = ModelsCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->update([
            'category_name' => $request->category_name,
        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category,
        ]);
    }

    public function destroy($id){
        $category = ModelsCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted Successfully']);
    }
}
