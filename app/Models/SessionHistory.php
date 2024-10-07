<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionHistory extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'psychologist_id', 'user_id', 'summary', 'ended_at'];
}
