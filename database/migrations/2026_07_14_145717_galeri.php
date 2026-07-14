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
        Schema::create('galeris', function (Blueprint $table) {

            $table->id();

            // Admin yang mengunggah
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Judul Foto
            $table->string('judul');

            // File gambar
            $table->string('gambar');

            // Deskripsi
            $table->text('deskripsi')->nullable();

            // Tanggal kegiatan
            $table->date('tanggal');

            // Status tampil
            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};