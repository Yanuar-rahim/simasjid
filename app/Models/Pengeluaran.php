<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $fillable = [
        'user_id',
        'kategori',
        'nominal',
        'keterangan',
        'tanggal',
        'bukti',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // Admin yang mencatat pengeluaran
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}