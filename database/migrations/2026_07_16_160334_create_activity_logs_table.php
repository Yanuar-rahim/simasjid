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
        Schema::create('activity_logs', function (Blueprint $table) {

            $table->id();

            // User yang melakukan aktivitas
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Jenis aktivitas
            // login, logout, donasi, registrasi, kegiatan, dll
            $table->string('aktivitas', 100);

            // Deskripsi lengkap
            $table->text('deskripsi');

            // Optional (admin,user,system)
            $table->string('role', 20)->nullable();

            // Optional icon FontAwesome
            $table->string('icon', 50)->nullable();

            // Optional warna badge
            $table->string('color', 30)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
