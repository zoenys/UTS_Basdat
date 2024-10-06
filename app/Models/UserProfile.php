<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles'; // Nama tabel yang benar
    protected $fillable = [
        'user_id',
        'medical_history',
    ];

    // Relasi belongsTo ke users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
