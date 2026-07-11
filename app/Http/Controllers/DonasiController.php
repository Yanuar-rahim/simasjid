<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis_donasi' => 'required',
            'nominal' => 'required|numeric|min:1000',
        ]);

        Donasi::create([
            'user_id'       => Auth::id(),
            'order_id'      => 'DONASI-' . time(),
            'nama_donatur'  => Auth::user()->name,
            'email'         => Auth::user()->email,
            'no_hp'         => Auth::user()->phone,
            'jenis_donasi'  => $request->jenis_donasi,
            'nominal'       => $request->nominal,
            'pesan'         => $request->pesan,
            'status'        => 'Menunggu',
            'tanggal'       => now(),
        ]);

        return back()->with('success', 'Donasi berhasil disimpan.');
    }
}
