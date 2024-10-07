<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['schedule_id', 'user_id', 'status'];

    public function schedule()
    {
        return $this->belongsTo(ConsultationSchedule::class, 'schedule_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'appointment_id');
    }
    
}
