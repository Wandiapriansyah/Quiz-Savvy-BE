<?php

namespace App\Http\Controllers;

use App\Models\RecapJawaban;
use Illuminate\Http\Request;

class RecapJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recap = RecapJawaban::all();
        return response()->json($recap, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'result_id' => 'required|exists:results,id',
            'question_id' => 'required|exists:questions,id',
            'jawaban_id' => 'required|exists:answers,id',
        ]);

        $recap = RecapJawaban::create($request->all());
        return response()->json($recap, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recap = RecapJawaban::with(['result', 'questions', 'answers'])->find($id);
        if (!$recap) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($recap);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'result_id' => 'nullable|exists:results,id',
            'question_id' => 'nullable|exists:questions,id',
            'jawaban_id' => 'nullable|exists:answers,id',
        ]);

        $recap = RecapJawaban::find($id);
        if (!$recap) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $recap->update($request->all());
        return response()->json($recap);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recap = RecapJawaban::find($id);
        if (!$recap) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $recap->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
