<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'is_correct' => 'required|boolean'
        ]);
    
        // Simpan jawaban
        Answer::create([
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'is_correct' => $request->is_correct,
        ]);
    
        return response()->json([
            'success' => true,
        ]);
    }
    
}
