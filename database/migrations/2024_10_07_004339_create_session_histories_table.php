<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('session_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); // Terkait ke room yang sudah selesai
            $table->unsignedBigInteger('psychologist_id'); // Psikolog yang mengakhiri sesi
            $table->unsignedBigInteger('user_id'); // Pasien dalam sesi tersebut
            $table->text('summary')->nullable(); // Ringkasan atau catatan sesi
            $table->timestamp('ended_at'); // Waktu sesi diakhiri
            $table->timestamps();
    
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('psychologist_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_histories');
    }
};
