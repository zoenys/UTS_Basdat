<?php

namespace App\Http\Controllers;

use App\Models\ConsultationSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Impor model User


class ConsultationScheduleController extends Controller
{
    // Tampilkan jadwal konsultasi dan formulir untuk membuat jadwal
    public function index()
    {
        // Ambil jadwal yang dimiliki oleh psikolog yang login beserta appointment dan user
        $schedules = ConsultationSchedule::with('appointments.user')
                        ->where('psychologist_id', Auth::id())
                        ->get();
        return view('sched', compact('schedules'));
    }

    public function showPatient($userId)
    {
        // Ambil detail pasien beserta profilnya (medical_history)
        $patient = User::with('userProfile')->findOrFail($userId);
    
        // Tampilkan view untuk profil pasien
        return view('patient_profile', compact('patient'));
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
}
