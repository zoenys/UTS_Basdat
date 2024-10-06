<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('consultation_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psychologist_id')->constrained('users')->onDelete('cascade'); // Menghubungkan dengan tabel users
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation_schedules');
    }
}
