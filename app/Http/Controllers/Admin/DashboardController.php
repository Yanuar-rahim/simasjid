<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donasi;
use App\Models\Kegiatan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik Utama
        |--------------------------------------------------------------------------
        */

        // Total pengguna
        $totalUser = User::where('role', 'user')->count();

        // User bulan ini
        $userBulanIni = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();


        // Total donasi diterima
        $totalDonasi = Donasi::where('status', 'Diterima')
            ->sum('nominal');


        // Donasi bulan ini
        $donasiBulanIni = Donasi::where('status', 'Diterima')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');


        // Total kegiatan
        $jumlahKegiatan = Kegiatan::count();


        // Kegiatan minggu ini
        $kegiatanMingguIni = Kegiatan::whereBetween('tanggal', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();


        /*
        |--------------------------------------------------------------------------
        | Saldo Kas
        |--------------------------------------------------------------------------
        */

        $totalPemasukan = Pemasukan::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        /*
        |--------------------------------------------------------------------------
        | Grafik Donasi Bulanan
        |--------------------------------------------------------------------------
        */

        Carbon::setLocale('id');
        $labels = [];
        $chartDonasi = [];


        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()
                ->month($i)
                ->translatedFormat('F');

            $chartDonasi[] = Donasi::where('status', 'Diterima')
                ->whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');
        }

        $kegiatanTerbaru = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Donasi Terbaru
        |--------------------------------------------------------------------------
        */

        $donasiTerbaru = Donasi::with('user')
            ->where('status', 'Diterima')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | User Terbaru
        |--------------------------------------------------------------------------
        */

        $userTerbaru = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'userBulanIni',
            'totalDonasi',
            'donasiBulanIni',
            'jumlahKegiatan',
            'kegiatanTerbaru',
            'saldoKas',
            'labels',
            'chartDonasi',
            'donasiTerbaru',
            'userTerbaru'
        ));
    }
}
