<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerScore extends Model
{
    use HasFactory;

    protected $table = "answerscore";
    protected $fillable = ["id_user", "id_quiz", "score"];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
