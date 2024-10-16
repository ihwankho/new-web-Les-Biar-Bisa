<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $table = 'Assignment';
    protected $fillable = ['nama', 'catatan', 'metode_pengumpulan', 'deadline', 'id_course'];
}
