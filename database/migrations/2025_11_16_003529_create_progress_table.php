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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();

            // Relasi ke 'users' (Student)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi ke 'contents' (Materi)
            $table->foreignId('content_id')->constrained()->onDelete('cascade');

            // 1 student hanya bisa complete 1 content 1x
            $table->unique(['user_id', 'content_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
