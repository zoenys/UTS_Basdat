<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        // Ambil appointments yang menunggu validasi
        $pendingAppointments = Appointment::with(['user', 'schedule.psychologist'])
            ->where('status', 'waiting_validation')
            ->get();
    
        // Ambil appointments yang sudah divalidasi
        $validatedAppointments = Appointment::with(['user', 'schedule.psychologist'])
            ->whereIn('status', ['approved', 'rejected'])
            ->get();
    
        return view('admin_validate', compact('pendingAppointments', 'validatedAppointments'));
    }

    public function approvePayment($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->status = 'approved';
            $appointment->save();
            return redirect()->route('admin.validate')->with('success', 'Pembayaran berhasil divalidasi.');
        }
        return redirect()->route('admin.validate')->with('error', 'Appointment tidak ditemukan.');
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
