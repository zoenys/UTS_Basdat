<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data ke tabel users
        DB::table('users')->insert([
            [
                'name' => 'Adelia',    // Admin
                'email' => 'adelia@example.com',
                'password' => Hash::make('password1'),  // bcrypt password1
                'role' => 'admin',
            ],
            [
                'name' => 'Mulyadi',   // Psikolog
                'email' => 'mulyadi@example.com',
                'password' => Hash::make('password2'),  // bcrypt password2
                'role' => 'psikolog',
            ],
            [
                'name' => 'Sumanto',   // Pengguna
                'email' => 'sumanto@example.com',
                'password' => Hash::make('password3'),  // bcrypt password3
                'role' => 'user',
            ],
        ]);
    }
}
