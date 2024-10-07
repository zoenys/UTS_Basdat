<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['room_id', 'sender_id', 'message'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
        // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}