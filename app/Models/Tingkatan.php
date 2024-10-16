<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkatan extends Model
{
    use HasFactory;
    protected $table = 'Tingkatan';
    protected $fillable = ['nama', 'jadwal'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'id_tingkatan');
    }
}
