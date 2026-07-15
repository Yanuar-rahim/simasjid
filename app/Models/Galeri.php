<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'user_id',
        'judul',
        'gambar',
        'deskripsi',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function galeri()
    {
        $galeri = Galeri::where('status', 1)
            ->latest()
            ->paginate(12);

        return view('user.galeri.index', compact('galeri'));
    }

    public function detailGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);

        return view('user.galeri.detail', compact('galeri'));
    }
}
