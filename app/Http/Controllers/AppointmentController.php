<?php

namespace App\Http\Controllers;

use App\Models\ConsultationSchedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\User;

class AppointmentController extends Controller
{
    public function availableSchedules(Request $request)
    {
        // Ambil ID psikolog dari URL
        $psychologistId = $request->psychologistId;
    
        // Ambil jadwal hanya milik psikolog yang dipilih oleh user
        $schedules = ConsultationSchedule::where('psychologist_id', $psychologistId)
                                         ->where('status', 'available') // Hanya jadwal yang tersedia
                                         ->get();
    
        // Kirim data jadwal ke view
        return view('choose-schedule', compact('schedules', 'psychologistId'));
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

    public function paymentStatus(Request $request)
    {
        // Ambil ID psikolog dari query string jika ada
        $psychologistId = $request->psychologistId;
    
        // Ambil appointments untuk user dan psikolog terkait
        $appointments = Appointment::where('user_id', Auth::id())
                                   ->whereHas('schedule', function($query) use ($psychologistId) {
                                       $query->where('psychologist_id', $psychologistId);
                                   })
                                   ->with('schedule')
                                   ->get();
    
        return view('status', compact('appointments', 'psychologistId'));
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
    public function showHistory()
    {
        // Ambil semua room yang sudah selesai, di mana user adalah psikolog atau user terkait
        $rooms = Room::with('appointment.schedule.psychologist', 'appointment.user')
                    ->whereHas('appointment', function($query) {
                        $query->where('user_id', Auth::id())
                              ->orWhereHas('schedule', function($q) {
                                  $q->where('psychologist_id', Auth::id());
                              });
                    })
                    ->get();
    
        // Kirim data rooms ke view
        return view('history', compact('rooms'));
    }
    

}
