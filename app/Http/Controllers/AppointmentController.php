<?php

namespace App\Http\Controllers;

use App\Models\ConsultationSchedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function availableSchedules()
    {
        // Menampilkan jadwal yang masih available untuk dipilih user
        $schedules = ConsultationSchedule::where('status', 'available')->get();
        return view('choose-schedule', compact('schedules'));
    }

    public function book(Request $request, $id)
    {
        $schedule = ConsultationSchedule::findOrFail($id);

        if ($schedule->status !== 'available') {
            return back()->withErrors('Jadwal sudah dipesan. Silakan pilih jadwal lain.');
        }

        // Ubah status jadwal menjadi booked
        $schedule->status = 'booked';
        $schedule->save();

        // Simpan appointment
        $appointment = Appointment::create([
            'schedule_id' => $schedule->id,
            'user_id' => Auth::id(),
            'status' => 'pending_payment', // Status awal: menunggu pembayaran
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('user.schedule.pay', $appointment->id)->with('success', 'Jadwal berhasil dipesan. Silakan lakukan pembayaran.');
    }

    public function paymentForm($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('bayar', compact('appointment'));
    }

    public function processPayment(Request $request, $id)
    {
        // Simulasi pembayaran
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'waiting_validation'; // Status menunggu validasi
        $appointment->save();

        return redirect()->route('user.schedule.status')->with('success', 'Pembayaran berhasil, menunggu validasi admin.');
    }

    public function paymentStatus()
    {
        $appointments = Appointment::where('user_id', Auth::id())->with('schedule')->get();
        return view('status', compact('appointments'));
    }

    public function validatePayment()
    {
        // Tampilkan daftar appointment untuk divalidasi oleh admin
        $appointments = Appointment::where('status', 'waiting_validation')->with('schedule')->get();
        return view('validasi', compact('appointments'));
    }

    public function approvePayment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'validated';
        $appointment->save();

        return redirect()->route('admin.validate.payment')->with('success', 'Pembayaran berhasil divalidasi.');
    }
}
