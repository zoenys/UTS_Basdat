<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\User;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\ConsultationSchedule;

class ChatController extends Controller
{
    public function showRoom($roomId)
    {
        // Mengambil data room beserta appointment dan jadwal (schedule)
        $room = Room::with('appointment.schedule')->findOrFail($roomId);
        
        // Ambil start_time dan end_time dari schedule
        $startTime = Carbon::parse($room->appointment->schedule->start_time);
        $endTime = Carbon::parse($room->appointment->schedule->end_time);
        $currentTime = Carbon::now();
        
        // Cek apakah sesi sudah selesai (done)
        if ($room->appointment->schedule->status === 'done') {
            // Jika sesi selesai, arahkan ke halaman status dengan pesan
            return redirect()->route('user.schedule.status')->with('message', 'Sesi telah selesai.');
        }
    
        // Jika waktu saat ini lebih dari end_time, timer sudah habis
        if ($currentTime->greaterThan($endTime)) {
            $remainingTime = 0;
        } else {
            // Hitung selisih waktu (dalam detik) antara waktu sekarang dan waktu akhir (end_time)
            $remainingTime = $endTime->diffInSeconds($currentTime);
        }
    
        // Pastikan user yang mengakses room adalah bagian dari sesi
        if (Auth::id() !== $room->appointment->user_id && Auth::id() !== $room->appointment->schedule->psychologist_id) {
            return redirect()->route('user.schedule.status')->with('error', 'Anda tidak memiliki akses ke sesi ini.');
        }
        
        // Ambil pengguna yang terlibat (psikolog dan user)
        $users = collect([$room->appointment->schedule->psychologist, $room->appointment->user]);
        
        // Kirim data ke view
        return view('chat', compact('room', 'remainingTime', 'users', 'startTime', 'endTime'));
    }
    
    
    public function sendMessage(Request $request, $roomId)
    {
        // Validasi input pesan
        $request->validate([
            'message' => 'required|string',
        ]);
    
        // Temukan room berdasarkan roomId
        $room = Room::findOrFail($roomId);
    
        // Pastikan user memiliki akses ke room ini
        if (Auth::id() !== $room->psychologist_id && Auth::id() !== $room->user_id) {
            return abort(403, 'Anda tidak punya akses ke room ini');
        }
    
        // Cek apakah sesi sudah selesai
        if ($room->appointment->schedule->status === 'done') {
            return redirect()->route('user.schedule.status')->with('message', 'Sesi telah selesai.');
        }
    
        // Simpan pesan baru
        Message::create([
            'room_id' => $room->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);
    
        // Redirect kembali ke chat room
        return redirect()->route('chat.show', $roomId);
    }
    
    public function endSession($roomId)
    {
        // Cari room berdasarkan ID
        $room = Room::with('appointment.schedule')->findOrFail($roomId);
    
        // Pastikan psikolog yang memiliki sesi yang bisa mengakhirinya
        if (Auth::user()->id === $room->appointment->schedule->psychologist_id) {
            // Tandai bahwa sesi sudah berakhir
            $schedule = $room->appointment->schedule;
            $schedule->status = 'done'; // Tandai sesi sebagai selesai
            $schedule->save();
    
            // Redirect psikolog ke halaman jadwal dengan pesan sukses
            return redirect()->route('psychologist.schedule.index')->with('message', 'Sesi telah diakhiri.');
        }
    
        // Jika bukan psikolog, arahkan user ke halaman status
        if (Auth::user()->id === $room->appointment->user_id) {
            return redirect()->route('user.schedule.status')->with('message', 'Sesi telah diakhiri oleh psikolog.');
        }
    
        return redirect()->back()->with('error', 'Anda tidak diizinkan untuk mengakhiri sesi ini.');
    }
    

    public function showHistory()
    {
        // Ambil riwayat sesi untuk psikolog yang sedang login
        $rooms = Room::whereHas('appointment.schedule', function ($query) {
            $query->where('psychologist_id', Auth::id());
        })->get();

        return view('history', compact('rooms'));
    }
    
    

    
    
}
