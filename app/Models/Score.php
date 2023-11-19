<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = "Score";
    protected $fillable = ['id_user', 'id_assignment', 'url', 'file', 'status', 'nilai', 'catatan'];
}
