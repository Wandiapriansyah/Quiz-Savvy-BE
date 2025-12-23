<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with(['user', 'quizzes'])->get();
        return response()->json($results);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer|min:0',
            'taken_at' => 'required|date',
        ]);

        $result = Result::create($request->only('user_id', 'quiz_id', 'score', 'taken_at'));

        return response()->json([
            'message' => 'Result created successfully',
            'result' => $result,
        ], 201);
    }

    public function show($id)
    {
        $result = Result::with(['user', 'quizzes'])->find($id);

        if (!$result) {
            return response()->json(['message' => 'Result not found'], 404);
        }

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer|min:0',
            'taken_at' => 'required|date',
        ]);

        $result = Result::find($id);

        if (!$result) {
            return response()->json(['message' => 'Result not found'], 404);
        }

        $result->update($request->only('user_id', 'quiz_id', 'score', 'taken_at'));

        return response()->json([
            'message' => 'Result updated successfully',
            'result' => $result,
        ]);
    }

    public function destroy($id)
    {
        $result = Result::find($id);

        if (!$result) {
            return response()->json(['message' => 'Result not found'], 404);
        }

        $result->delete();

        return response()->json(['message' => 'Result deleted successfully']);
    }
}
