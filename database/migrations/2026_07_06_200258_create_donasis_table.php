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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('nama_donatur');
            $table->enum('jenis_donasi', [
                'Infak',
                'Sedekah',
                'Wakaf',
                'Pembangunan'
            ]);
            $table->string('email');
            $table->string('no_hp');
            $table->integer('nominal');
            $table->enum('metode', [
                'Transfer Bank',
                'QRIS',
                'Tunai'
            ]);
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', [
                'Menunggu',
                'Diterima',
                'Ditolak'
            ])->default('Menunggu');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};