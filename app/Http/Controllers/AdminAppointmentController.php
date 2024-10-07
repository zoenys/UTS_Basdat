<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Room;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        // Mengambil semua appointment dengan status waiting_validation
        $pendingAppointments = Appointment::with(['user', 'schedule.psychologist'])
            ->where('status', 'waiting_validation')
            ->get();

        // Mengambil semua appointment yang sudah divalidasi
        $validatedAppointments = Appointment::with(['user', 'schedule.psychologist'])
            ->where('status', 'approved') // Assuming 'approved' means validated
            ->orWhere('status', 'rejected') // In case you want to show rejected as well
            ->get();

        // Kirim data appointments ke view admin_validate
        return view('admin_validate', compact('pendingAppointments', 'validatedAppointments'));
    }

    public function approvePayment($id)
    {
        // Find the appointment
        $appointment = Appointment::with('schedule')->find($id);
    
        if (!$appointment) {
            return redirect()->route('admin.validate')->with('error', 'Appointment tidak ditemukan.');
        }
    
        // Approve the appointment
        $appointment->status = 'approved';
        $appointment->save();
    
        // Get the psychologist ID from the schedule (ensure schedule exists)
        $psychologistId = $appointment->schedule->psychologist_id ?? null;
        $userId = $appointment->user_id;
    
        // Check if psychologistId and userId are valid
        if (!$psychologistId || !$userId) {
            return redirect()->route('admin.validate')->with('error', 'Tidak bisa membuat ruang chat, informasi psikolog atau user tidak ditemukan.');
        }
    
        // Check if a room already exists, otherwise create a new one
        $existingRoom = Room::where('appointment_id', $appointment->id)->first();
        if (!$existingRoom) {
            Room::create([
                'appointment_id' => $appointment->id,
                'psychologist_id' => $psychologistId,
                'user_id' => $userId,
            ]);
        }
    
        return redirect()->route('admin.validate')->with('success', 'Pembayaran berhasil divalidasi dan ruang chat telah dibuat.');
    }
    

    public function rejectPayment($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->status = 'rejected';
            $appointment->save();
            return redirect()->route('admin.validate')->with('success', 'Pembayaran ditolak.');
        }
        return redirect()->route('admin.validate')->with('error', 'Appointment tidak ditemukan.');
    }
}
