<?php

namespace App\Http\Controllers;

use App\Models\AnswerScore;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Menampilkan daftar pertanyaan untuk quiz tertentu
    public function index(Quiz $quiz)
    {
        // Ambil semua pertanyaan terkait quiz
        $questions = $quiz->questions;

        $answers = AnswerScore::where('id_quiz', $quiz->id)->with('user')->get();

        // Tampilkan view untuk menampilkan daftar pertanyaan
        return view('admin.page.questions.index', compact('quiz', 'questions', 'answers'));
    }

    public function create($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('admin.page.questions.create', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        $validation = $request->validate([
            'question' => 'required|string',
            'pilihan_1' => 'required',
            'pilihan_2' => 'required',
            'pilihan_3' => 'required',
            'pilihan_4' => 'required',
            'jawaban_benar' => 'required',
        ]);

        $option = 'pilihan_1:' . $request->pilihan_1 . ',pilihan_2:' . $request->pilihan_2 . ',pilihan_3:' . $request->pilihan_3 . ',pilihan_4:' . $request->pilihan_4;

        $question = Question::create([
            'quiz_id' => $quizId,
            'question' => $request->question,
            'option' => $option,
            'is_correct' => $request->jawaban_benar,
        ]);

        return redirect()
            ->route('questions.index', ['quiz' => $quizId])
            ->with('success', 'Soal Berhasil Ditambahkan!');
    }

    public function destroy($id)
    {
        $question = Question::find($id);

        if ($question) {
            $question->delete();
            return redirect()->back()->with('success_question', 'Soal berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Soal tidak ditemukan.');
    }
}
