<?php

namespace App\Http\Controllers;

use App\Models\QuizCategory;
use Illuminate\Http\Request;

class QuizCategoryController extends Controller
{
    public function index(){
        $quizCategories = QuizCategory::with(['quiz', 'category'])->get();
        return response()->json($quizCategories);
    }

    public function store(Request $request){
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $quizCategories = QuizCategory::create($request->only('quiz_id', 'category_id'));

        return response()->json([
            'message' => 'Quiz category created siccessfully',
            'quiz_category' => $quizCategories,
        ], 201);
    }

    public function show($id){
        $quizCategories = QuizCategory::with(['quiz', 'category'])->find($id);
        if (!$quizCategories) {
            return response()->json(['message' => 'Quiz category not found'], 404);
        }

        return response()->json($quizCategories);
    }

    public function update(Request $request, $id){
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $quizCategories = QuizCategory::find($id);
        if (!$quizCategories) {
            return response()->json(['message' => 'Quiz category not found'], 404);
        }

        $quizCategories->update($request->only('quiz_id', 'category_id'));

        return response()->json([
            'message' => 'Quiz category updated successfully',
            'quiz_category' => $quizCategories,
        ]);
    }

    public function destroy($id){
        $quizCategories = QuizCategory::find($id);
        if (!$quizCategories) {
            return response()->json(['message' => 'Quiz category not found'], 404);
        }

        $quizCategories->delete();
        return response()->json(['message' => 'Quiz category deleted successfully']);
    }
}
