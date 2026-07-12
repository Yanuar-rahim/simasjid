<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'nama_donatur',
        'email',
        'no_hp',
        'jenis_donasi',
        'nominal',
        'pesan',
        'metode',
        'transaction_id',
        'snap_token',
        'payment_type',
        'transaction_status',
        'transaction_time',
        'status',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'nominal' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
