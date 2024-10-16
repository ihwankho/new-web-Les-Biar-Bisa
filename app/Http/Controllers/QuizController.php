<?php

namespace App\Http\Controllers;

use App\Mail\QuizNotificationMail;
use App\Models\AnswerScore;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Tingkatan;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuizController extends Controller
{
    // Method untuk menampilkan daftar quiz
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.page.quiz.index', compact('quizzes'));
    }

    public function status(Request $request, $quizId)
    {
        $quiz = Quiz::find($quizId);

        if (!$quiz) {
            return back()->with('error', 'Kuis tidak ditemukan.');
        }

        $quiz->is_ready = !$quiz->is_ready;
        $quiz->save();

        if ($quiz->is_ready) {
            $users = User::where('id_tingkatan', $quiz->id_tingkatan)->get();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new QuizNotificationMail('Quiz', $quiz->name));
            }
        }

        return back()->with('success_quiz', 'Status kuis berhasil diperbarui.');
    }

    public function studentindex(Request $request)
    {
        $client = new Client();
        $url = env('API_URL');

        $user = json_decode(
            $client
                ->request('GET', $url . '/users/' . $request->session()->get('id_user'), [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $request->session()->get('token'),
                    ],
                ])
                ->getBody(),
            true,
        )['data'];

        $id_tingkatan = $user['id_tingkatan'];

        $quizzes = Quiz::where('id_tingkatan', $id_tingkatan)->get();
        $answers = AnswerScore::where('id_user', $request->session()->get('id_user'))->get();

        $quiz = collect();

        foreach ($quizzes as $index => $quizes) {
            $count = Question::where('quiz_id', $quizes->id)->count();

            $answeredQuiz = $answers->firstWhere('id_quiz', $quizes->id);

            $score = null;
            if ($answeredQuiz) {
                $score = $answeredQuiz->score;
            }
            $quiz->push([
                'id_quiz' => $quizes->id,
                'name' => $quizes->name,
                'number_of_questions' => $count,
                'score' => $score,
                'is_ready' => $quizes->is_ready,
            ]);
        }

        return view('users.page.quizzess.index', compact('quiz'));
    }

    public function studentshow(Request $request, $id)
    {
        $questions = Question::where('quiz_id', $id)->get();

        return view('users.page.quizzess.show', [
            'questions' => $questions,
            'quiz_id' => $id,
        ]);
    }

    public function studentsubmit(Request $request, $quiz)
    {
        $answers = $request->input('answers');
        $score = 0;

        foreach ($answers as $questionId => $selectedAnswer) {
            $question = Question::find($questionId);
            $correctAnswer = $question->is_correct;

            if ($selectedAnswer == $correctAnswer) {
                $score++;
            }
        }

        $score = ($score / count($answers)) * 100;

        AnswerScore::create([
            'id_user' => $request->session()->get('id_user'),
            'id_quiz' => $quiz,
            'score' => $score,
        ]);

        return view('users.page.quizzess.result', ['score' => $score, 'total' => count($answers)]);
    }

    // Method untuk membuat quiz baru (form view)
    public function create()
    {
        $tingkatan = Tingkatan::all();
        return view('admin.page.quiz.create', compact('tingkatan'));
    }

    // Method untuk menyimpan quiz baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'id_tingkatan' => 'required|exists:Tingkatan,id',
        ]);

        // Simpan data quiz ke dalam database
        Quiz::create([
            'name' => $request->name,
            'id_tingkatan' => $request->id_tingkatan,
        ]);

        //\Mail::to($user->email)->send(new QuizNotificationMail);
        // Redirect setelah berhasil menyimpan
        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil ditambahkan.');
    }

    // Method untuk menampilkan detail quiz
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.page.quiz.show', compact('quiz'));
    }
    public function edit(Quiz $quiz)
    {
        // Ambil data tingkatan untuk pilihan dropdown
        $tingkatan = Tingkatan::all();

        // Tampilkan view untuk edit quiz dengan data quiz dan tingkatan
        return view('admin.page.quiz.edit', compact('quiz', 'tingkatan'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'tingkatan_id' => 'required|exists:tingkatan,id',
        ]);

        // Update quiz dengan data yang baru
        $quiz->update([
            'name' => $request->name,
            'tingkatan_id' => $request->tingkatan_id,
        ]);

        // Redirect ke halaman daftar quiz dengan pesan sukses
        return redirect()->route('admin.page.quiz.index')->with('success', 'Quiz berhasil diperbarui!');
    }
    public function destroy(Quiz $quiz)
    {
        // Hapus quiz dari database
        $quiz->delete();

        // Redirect ke halaman daftar quiz dengan pesan sukses
        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil dihapus!');
    }
}
