<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;


class KeuanganController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::latest()->take(10)->get();
        $pengeluaran = Pengeluaran::latest()->take(10)->get();

        $totalPemasukan = Pemasukan::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        // Data Grafik 12 Bulan
        $chartPemasukan = [];
        $chartPengeluaran = [];

        for ($i = 1; $i <= 12; $i++) {

            $chartPemasukan[] = Pemasukan::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');

            $chartPengeluaran[] = Pengeluaran::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');
        }

        return view('admin.keuangan.index', compact(
            'pemasukan',
            'pengeluaran',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'chartPemasukan',
            'chartPengeluaran'
        ));
    }
}
