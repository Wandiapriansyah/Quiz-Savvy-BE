<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(){
        $quiz = Quiz::all();

        $quiz->each(function ($quiz) {
            if ($quiz->gambar) {
                $quiz->gambar = $quiz->gambar ? asset('storage/' . $quiz->gambar) : asset('storage/images/quizzes/Group_13.png');
            }
        });

        return response()->json($quiz);
    }

    public function show($id){
        $quiz = Quiz::with('creator:id,email')->find($id);
        if(!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        return response()->json($quiz, 200);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'createdBy' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images/quizzes', 'public');
            $imageUrl = url('/storage/' . $imagePath);
        } else {
            $imageUrl = url('/storage/images/quizzes/Group_13.png');
        }

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'gambar' => $imageUrl,
            'createdBy' => $request->createdBy,
        ]);
        
        return response()->json(['message' => 'Quiz created successfully', 'quiz' => $quiz], 201);
    }

    public function update(Request $request, $id){

        $quiz = Quiz::find($id);
        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $quiz->title = $request->title;
        $quiz->description = $request->description;

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images/quizzes', 'public');
            $quiz->gambar = $imagePath;
        }

        $quiz->save();

        return response()->json(['message' => 'Quiz updated succesfully', 'quiz' => $quiz], 200);
    }

    public function destroy($id){
        $quiz = Quiz::find($id);
        if(!$quiz){
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        foreach ($quiz->questions as $question) {
            $question->answers()->delete();
        }

        $quiz->questions()->delete();

        $quiz->delete();

        return response()->json(['message' => 'Quiz deleted successfully'], 200);
    }

    public function createdBy(Request $request) {
        $userId = $request->input('createdBy');

        $quizzes = Quiz::where('createdBy', $userId)->get();
        
        $quizzes->each(function ($quizzes) {
            if ($quizzes->gambar) {
                $quizzes->gambar = $quizzes->gambar ? asset('storage/' . $quizzes->gambar) : asset('storage/images/quizzes/Group_13.png');
            }
        });

        return response()->json($quizzes);
    }
}
