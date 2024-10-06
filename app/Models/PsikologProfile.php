<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsikologProfile extends Model
{
    use HasFactory;

    protected $table = 'psikolog_profiles'; // Ubah ke nama tabel yang benar
    protected $fillable = ['user_id', 'specialization', 'experience', 'hire_date'];

    // Relasi ke User (Psikolog adalah bagian dari User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

