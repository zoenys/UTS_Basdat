<?php

namespace App\Http\Controllers;

use App\Models\PsikologProfile;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Tampilkan daftar psikolog.
     */
    public function doctor()
    {
        // Ambil data semua psikolog dari tabel psikolog_profiles
        $psychologists = PsikologProfile::with('user')->get();

        // Kirim data ke view doctor.blade.php
        return view('doctor', compact('psychologists'));
    }
}
