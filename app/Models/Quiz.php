<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = ['name', 'id_tingkatan'];

    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'id_tingkatan');
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
