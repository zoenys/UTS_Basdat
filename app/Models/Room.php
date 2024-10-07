<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['appointment_id', 'psychologist_id', 'user_id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }
    public function schedule()
    {
        return $this->appointment->schedule; // Mendapatkan schedule dari appointment
    }

    public function isSessionActive()
    {
        $endTime = $this->schedule->end_time;
        return $endTime > now(); // Cek apakah sesi masih aktif berdasarkan schedule
    }

}
