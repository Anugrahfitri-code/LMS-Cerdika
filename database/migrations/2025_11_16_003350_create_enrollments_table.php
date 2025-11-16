<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // Relasi ke 'users' (Student)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi ke 'courses'
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            // 1 student hanya bisa daftar 1x di 1 course
            $table->unique(['user_id', 'course_id']); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
