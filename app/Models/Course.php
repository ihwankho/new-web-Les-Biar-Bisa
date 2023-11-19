<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'Course';
    protected $fillable = ['nama', 'deskripsi', 'id_tingkatan'];

    public function file_course()
    {
        return $this->belongsTo(FileCourse::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
