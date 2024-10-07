<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('consultation_schedules', function (Blueprint $table) {
            // Tambah status 'in_progress' dan 'done' ke kolom status jika ENUM
            $table->enum('status', ['available', 'booked', 'in_progress', 'done'])->change();
        });
    }

    /**
     * Batalkan perubahan.
     */
    public function down()
    {
        Schema::table('consultation_schedules', function (Blueprint $table) {
            // Kembali ke nilai status sebelumnya jika dibatalkan
            $table->enum('status', ['available', 'booked'])->change();
        });
    }
};
