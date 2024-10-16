<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // Nama tabel, jika berbeda dari default (yaitu 'answers')
    protected $table = 'answers';

    // Definisi kolom-kolom yang bisa diisi (fillable)
    protected $fillable = [
        'question_id', // Foreign key untuk menghubungkan ke tabel questions
        'answer',      // Teks jawaban (opsi jawaban)
        'is_correct'   // Status jawaban benar (1 = benar, 0 = salah)
    ];

    /**
     * Relasi dengan model Question.
     * Jawaban terkait dengan satu pertanyaan.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Scope untuk mendapatkan jawaban yang benar.
     */
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }
}
