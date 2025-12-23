<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::with('quiz')->get();
        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'question_type' => 'required|string',
        ]);

        $question = Question::create($request->only('quiz_id', 'question_text', 'question_type'));

        return response()->json([
            'message' => 'Question created successfully',
            'question' => $question,
        ], 201);
    }

    public function show($id)
    {
        $question = Question::with('quiz')->find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        return response()->json($question);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'question_type' => 'required|string',
        ]);

        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $question->update($request->only('quiz_id', 'question_text', 'question_type'));

        return response()->json([
            'message' => 'Question updated successfully',
            'question' => $question,
        ]);
    }

    public function destroy($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted successfully']);
    }

    public function getQuestionWithAnswers($quiz_id)
    {
        $questions = Question::where('quiz_id', $quiz_id)
        ->with('answers')
        ->get();

        if ($questions->isEmpty()) {
            return response()->json(['message' => 'No questions found for this quiz'], 404);
        }

        return response()->json($questions);
    }
}
