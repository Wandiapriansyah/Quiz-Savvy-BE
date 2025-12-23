<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::with('question')->get();
        return response()->json($answers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'jawaban_pilihan' => 'required|string',
            'jawaban_valid' => 'required|boolean',
        ]);

        $answer = Answer::create($request->only('question_id', 'jawaban_pilihan', 'jawaban_valid'));

        return response()->json([
            'message' => 'Answer created successfully',
            'answer' => $answer,
        ], 201);
    }

    public function show($id)
    {
        $answer = Answer::with('question')->find($id);

        if (!$answer) {
            return response()->json(['message' => 'Answer not found'], 404);
        }

        return response()->json($answer);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'jawaban_pilihan' => 'required|string',
            'jawaban_valid' => 'required|boolean',
        ]);

        $answer = Answer::find($id);

        if (!$answer) {
            return response()->json(['message' => 'Answer not found'], 404);
        }

        $answer->update($request->only('question_id', 'jawaban_pilihan', 'jawaban_valid'));

        return response()->json([
            'message' => 'Answer updated successfully',
            'answer' => $answer,
        ]);
    }

    public function destroy($id)
    {
        $answer = Answer::find($id);

        if (!$answer) {
            return response()->json(['message' => 'Answer not found'], 404);
        }

        $answer->delete();

        return response()->json(['message' => 'Answer deleted successfully']);
    }
}
