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

            // User yang melakukan donasi
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // ID transaksi internal
            $table->string('order_id')->unique();

            // Informasi Donatur
            $table->string('nama_donatur');
            $table->string('email');
            $table->string('no_hp');

            // Jenis Donasi
            $table->enum('jenis_donasi', [
                'Infak',
                'Sedekah',
                'Wakaf',
                'Pembangunan'
            ]);

            // Nominal
            $table->bigInteger('nominal');

            // Metode pembayaran yang dipilih Midtrans
            $table->string('metode')->nullable();

            // Midtrans
            $table->string('transaction_id')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('transaction_status')->nullable();
            $table->timestamp('transaction_time')->nullable();

            // Status Donasi
            $table->enum('status', [
                'Menunggu',
                'Diterima',
                'Ditolak'
            ])->default('Menunggu');

            // Pesan / doa
            $table->text('pesan')->nullable();

            // Tanggal Donasi
            $table->timestamp('tanggal')->useCurrent();

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
