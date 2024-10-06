<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID user dari tabel users
        $adminId = DB::table('users')->where('email', 'adelia@example.com')->value('id');
        $psikologId = DB::table('users')->where('email', 'mulyadi@example.com')->value('id');
        $userId = DB::table('users')->where('email', 'sumanto@example.com')->value('id');

        // Masukkan data ke tabel admin_profiles
        DB::table('admin_profiles')->insert([
            'user_id' => $adminId,
            'name' => 'Adelia',
            'hire_date' => now(), // Tanggal mulai bekerja
        ]);

        // Masukkan data ke tabel psikolog_profiles
        DB::table('psikolog_profiles')->insert([
            'user_id' => $psikologId,
            'name' => 'Mulyadi',
            'specialization' => 'Psikologi Klinis',
            'experience' => 5, // Misal pengalaman 5 tahun
            'hire_date' => now(),
        ]);

        // Masukkan data ke tabel user_profiles
        DB::table('user_profiles')->insert([
            'user_id' => $userId,
            'name' => 'Sumanto',
            'medical_history' => 'Riwayat medis contoh: diabetes', // Riwayat medis
        ]);
    }
}
