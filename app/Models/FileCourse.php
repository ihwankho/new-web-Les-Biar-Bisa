<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCourse extends Model
{
    use HasFactory;
    protected $table = 'File_course';
    protected $fillable = ['nama', 'file', 'id_course', 'link'];
}
