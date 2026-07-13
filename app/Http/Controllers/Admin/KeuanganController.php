<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class KeuanganController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::with('user')
            ->latest('tanggal')
            ->get();

        $pengeluaran = Pengeluaran::with('user')
            ->latest('tanggal')
            ->get();

        $totalPemasukan = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        return view('admin.keuangan.index', compact(
            'pemasukan',
            'pengeluaran',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas'
        ));
    }
}