<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
    protected $fillable = ['nama', 'note', 'status', 'bukti', 'id_user', 'id_tingkatan'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'id_tingkatan');
    }
}
