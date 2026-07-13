<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';

    protected $fillable = [
        'donasi_id',
        'user_id',
        'sumber',
        'nominal',
        'keterangan',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // Pemasukan berasal dari donasi (opsional)
    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    // Admin/User yang menginput pemasukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}