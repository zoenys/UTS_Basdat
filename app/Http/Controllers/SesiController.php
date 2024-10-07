<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile; // Pastikan Model ini ada jika kamu ingin menghubungkan dengan profile

class SesiController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('login'); 
    }

    /**
     * Tampilkan form register.
     */
    public function showRegisterForm()
    {
        return view('register'); // Menampilkan view register.blade.php
    }

    /**
     * Tangani proses register.
     */
    public function register(Request $request)
    {
        // Validasi input dari form register
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'medical_history' => 'nullable|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.'
        ]);
    
        // Jika validasi gagal, kembalikan error
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default mendaftar sebagai user
        ]);
    
        // Simpan medical history jika ada
        if ($request->medical_history) {
            UserProfile::create([
                'user_id' => $user->id,
                'medical_history' => $request->medical_history,
            ]);
        }
    
        // Redirect ke halaman login setelah registrasi sukses
        return redirect()->route('login')->with('status', 'Registrasi berhasil, silahkan login.');
    }

    /**
     * Tangani proses login.
     */
    public function login(Request $request)
    {
        // Validasi input dari form login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Harap mengisi email',
            'email.email' => 'Harap masukkan email yang valid',
            'password.required' => 'Harap mengisi password',
        ]);
    
        // Jika validasi gagal, kembali dengan error
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            // Jika email tidak ditemukan
            return back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
        }
    
        // Cek apakah password salah
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika password salah
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }
    
        // Jika login berhasil, regenerasi sesi untuk keamanan
        $request->session()->regenerate();
    
        // Periksa role pengguna dan arahkan ke halaman yang sesuai
        switch ($user->role) {
            case 'admin':
                return redirect('/admin_validate')->with('status', 'Selamat datang Admin');
            case 'psikolog':
                return redirect('/sched')->with('status', 'Selamat datang Psikolog');
            case 'user':
                return redirect('/doctor')->with('status', 'Selamat datang Pasien');
            default:
                Auth::logout();
                return redirect('/')->withErrors(['.' => 'Role tidak dikenali.']);
        }
    }

    /**
     * Menampilkan halaman validasi untuk admin.
     */
    public function admin_validate()
    {
        return view('admin_validate')->with('status', 'Halaman Validasi Admin');
    }

    /**
     * Menampilkan halaman jadwal untuk psikolog.
     */
    public function sched()
    {
        return view('sched')->with('status', 'Halaman Penjadwalan Psikolog');
    }

    /**
     * Menampilkan halaman dokter untuk user.
     */
    public function doctor()
    {
        return view('doctor')->with('status', 'Halaman Konsultasi Dokter');
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Anda telah berhasil logout.');
    }
}
