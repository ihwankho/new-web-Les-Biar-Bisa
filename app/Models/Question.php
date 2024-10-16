<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika mengikuti konvensi Laravel)
    protected $table = 'questions';

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'quiz_id',
        'question',
        'option',
        'is_correct'
    ];

    // Relasi dengan model Quiz (satu pertanyaan terkait dengan satu quiz)
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }


    // Relasi dengan model Answer (satu pertanyaan bisa memiliki banyak jawaban)
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
