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
        Schema::create('masjid', function (Blueprint $table) {
            $table->id();

            // Informasi Masjid
            $table->string('nama_masjid');
            $table->text('alamat');
            $table->string('telepon', 30)->nullable();
            $table->string('email')->nullable();

            // Ketua Takmir
            $table->string('ketua_takmir')->nullable();

            // Profil Masjid
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();

            // Google Maps (iframe/embed)
            $table->longText('google_maps')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masjid');
    }
};