<?php

namespace App\Http\Controllers;

use App\Models\ConsultationSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Impor model User
use App\Models\Room;
use App\Models\Appointment; // Impor model Appointment


class ConsultationScheduleController extends Controller
{
    // Tampilkan jadwal konsultasi dan formulir untuk membuat jadwal
    public function index()
    {
        // Hanya ambil jadwal yang belum selesai
        $schedules = ConsultationSchedule::where('psychologist_id', Auth::id())
                        ->where('status', '!=', 'done') // Sembunyikan sesi yang sudah selesai
                        ->with('appointments.user')
                        ->get();
    
        return view('sched', compact('schedules'));
    }
    

    public function showPatient($userId)
    {
        // Ambil detail pasien
        $patient = User::with('userProfile')->findOrFail($userId);
    
        // Ambil appointment terkait pasien dan psikolog yang sedang login
        $appointment = Appointment::whereHas('schedule', function ($query) {
            $query->where('psychologist_id', Auth::id());
        })->where('user_id', $userId)
          ->with('room') // Pastikan untuk mengambil relasi room
          ->first();
    
        // Jika room belum ada, buat room baru
        if ($appointment && !$appointment->room) {
            $room = Room::create([
                'appointment_id' => $appointment->id,
                'psychologist_id' => $appointment->schedule->psychologist_id,
                'user_id' => $appointment->user_id,
            ]);
            $appointment->load('room'); // Reload appointment untuk mendapatkan room terbaru
        }
    
        // Tampilkan view dengan data yang benar
        return view('patient_profile', compact('patient', 'appointment'));
    }
    
    
    
    

    // Simpan jadwal konsultasi
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Cek apakah jadwal bentrok
        $overlappingSchedule = ConsultationSchedule::where('psychologist_id', Auth::id())
            ->where('date', $request->date)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($overlappingSchedule) {
            return back()->withErrors('Jadwal bentrok dengan jadwal lain. Silakan pilih waktu yang berbeda.');
        }

        // Simpan jadwal
        ConsultationSchedule::create([
            'psychologist_id' => Auth::id(),
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('psychologist.schedule.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function chooseSchedule(Request $request)
    {
        // Ambil ID psikolog yang dipilih
        $psychologistId = $request->psychologistId;
    
        // Ambil jadwal hanya milik psikolog yang dipilih oleh user
        $schedules = ConsultationSchedule::where('psychologist_id', $psychologistId)
                                         ->where('status', 'available') // Hanya jadwal yang tersedia
                                         ->get();
    
        // Ambil semua psikolog untuk dropdown, agar user bisa memilih ulang psikolog
        $psychologists = User::where('role', 'psikolog')->get();
    
        return view('choose_schedule', compact('schedules', 'psychologists', 'psychologistId'));
    }
    
    
}
