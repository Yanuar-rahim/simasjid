<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Landing Page Guest
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        return view('index', compact(
            'kegiatan',
            'pengumuman'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Landing Page User Login
    |--------------------------------------------------------------------------
    */

    public function userHome()
    {
        $user = auth()->user();

        /*
    |--------------------------------------------------------------------------
    | Statistik Donatur
    |--------------------------------------------------------------------------
    */

        $totalDonasi = Donasi::where('user_id', $user->id)
            ->where('status', 'Diterima')
            ->sum('nominal');

        $jumlahDonasi = Donasi::where('user_id', $user->id)
            ->where('status', 'Diterima')
            ->count();

        $donasiTerakhir = Donasi::where('user_id', $user->id)
            ->where('status', 'Diterima')
            ->latest('tanggal')
            ->first();

        /*
    |--------------------------------------------------------------------------
    | Kegiatan
    |--------------------------------------------------------------------------
    */

        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Pengumuman
    |--------------------------------------------------------------------------
    */

        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Galeri
    |--------------------------------------------------------------------------
    */

        $galeri = Galeri::latest()
            ->take(10)
            ->get();

        
        /*
    |--------------------------------------------------------------------------
    | Statistik Masjid
    |--------------------------------------------------------------------------
    */

        $totalPemasukan = Pemasukan::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        return view('home.index', compact(
            'totalDonasi',
            'jumlahDonasi',
            'donasiTerakhir',

            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',

            'kegiatan',
            'pengumuman',
            'galeri'
        ));
    }

    public function donasi()
    {
        return view('home.donasi.index');
    }

    public function riwayat(Request $request)
    {
        $userId = auth()->id();

        $query = Donasi::query()
            ->where('user_id', $userId);

        $allowedJenis = ['Infak', 'Sedekah', 'Wakaf', 'Pembangunan'];

        if ($request->filled('jenis') && in_array($request->jenis, $allowedJenis, true)) {
            $query->where('jenis_donasi', $request->jenis);
        }

        $donasi = $query
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        $totalDonasi = Donasi::where('user_id', $userId)
            ->where('status', 'Diterima')
            ->sum('nominal');

        $jumlahTransaksi = Donasi::where('user_id', $userId)->count();

        $donasiTerakhir = Donasi::where('user_id', $userId)
            ->latest('tanggal')
            ->first();

        $distribusi = Donasi::query()
            ->where('user_id', $userId)
            ->selectRaw('jenis_donasi, count(*) as total')
            ->groupBy('jenis_donasi')
            ->pluck('total', 'jenis_donasi');

        return view('home.riwayat.index', compact(
            'donasi',
            'totalDonasi',
            'jumlahTransaksi',
            'donasiTerakhir',
            'distribusi',
            'allowedJenis',
        ));
    }

    public function keuangan()
    {
        $pemasukan = Pemasukan::latest('tanggal')->get();
        $pengeluaran = Pengeluaran::latest('tanggal')->get();
        $totalPemasukan = Pemasukan::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        /*
    |--------------------------------------------------------------------------
    | Grafik Bulanan
    |--------------------------------------------------------------------------
    */

        $bulan = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $chartPemasukan = [];
        $chartPengeluaran = [];

        foreach (range(1, 12) as $i) {

            $chartPemasukan[] = Pemasukan::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');

            $chartPengeluaran[] = Pengeluaran::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');
        }

        /*
    |--------------------------------------------------------------------------
    | Rekap Bulanan
    |--------------------------------------------------------------------------
    */

        $rekapBulanan = [];

        foreach (range(1, 12) as $i) {

            $masuk = Pemasukan::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');

            $keluar = Pengeluaran::whereMonth('tanggal', $i)
                ->whereYear('tanggal', now()->year)
                ->sum('nominal');

            $rekapBulanan[] = [

                'bulan' => $bulan[$i - 1],

                'pemasukan' => $masuk,

                'pengeluaran' => $keluar,

                'saldo' => $masuk - $keluar

            ];
        }

        return view('home.keuangan.index', compact(

            'pemasukan',
            'pengeluaran',

            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',

            'chartPemasukan',
            'chartPengeluaran',

            'rekapBulanan'

        ));
    }
    public function kegiatan()
    {
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('home.kegiatan.index', compact('kegiatan'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('home.pengumuman.index', compact('pengumuman'));
    }

    public function publicKegiatan()
    {
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('kegiatan.index', compact('kegiatan'));
    }

    public function publicPengumuman()
    {
        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('pengumuman.index', compact('pengumuman'));
    }

    /*
    |--------------------------------------------------------------------------
    | Detail Kegiatan
    |--------------------------------------------------------------------------
    */

    public function showKegiatan($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail();

        $lainnya = Kegiatan::where('status', 'Aktif')
            ->where('id', '!=', $kegiatan->id)
            ->latest()
            ->take(3)
            ->get();

        return view('kegiatan.detail', compact(
            'kegiatan',
            'lainnya'
        ));
    }

    public function userShowKegiatan($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail();

        $lainnya = Kegiatan::where('status', 'Aktif')
            ->where('id', '!=', $kegiatan->id)
            ->latest()
            ->take(3)
            ->get();

        return view('home.kegiatan.detail', compact(
            'kegiatan',
            'lainnya'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Detail Pengumuman
    |--------------------------------------------------------------------------
    */

    public function showPengumuman($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail();

        $pengumumanTerbaru = Pengumuman::where('status', 'Aktif')
            ->where('id', '!=', $pengumuman->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pengumuman.detail', compact(
            'pengumuman',
            'pengumumanTerbaru'
        ));
    }

    public function userShowPengumuman($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
            ->where('status', 'Aktif')
            ->firstOrFail();

        $pengumumanTerbaru = Pengumuman::where('status', 'Aktif')
            ->where('id', '!=', $pengumuman->id)
            ->latest()
            ->take(3)
            ->get();

        return view('home.pengumuman.detail', compact(
            'pengumuman',
            'pengumumanTerbaru'
        ));
    }
}
