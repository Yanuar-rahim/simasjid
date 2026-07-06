<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_donatur',
        'jenis_donasi',
        'email',
        'no_hp',
        'nominal',
        'metode',
        'bukti_transfer',
        'doa',
        'status',
        'catatan_admin',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
