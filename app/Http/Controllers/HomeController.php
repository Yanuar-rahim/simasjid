<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Donasi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Masjid;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Services\AladhanService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Landing Page Guest
    |--------------------------------------------------------------------------
    */
    public function index(AladhanService $jadwal)
    {

        // $user = Auth::user();

        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        $galeri = Galeri::where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        $masjid = Masjid::first();
        $jumlahJamaah = User::where('role', 'user')->count();
        $jumlahPengurus = User::where('role', 'admin')->count();
        $jumlahKegiatan = Kegiatan::count();
        $totalDonasi = Donasi::where('status', 'Diterima')->sum('nominal');
        $totalPemasukan = Pemasukan::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;
        $jadwalSholat = $jadwal->getJadwal();
        $targetPembangunan = $masjid->target_pembangunan ?? 0;
        $danaTerkumpul = $masjid->dana_terkumpul ?? 0;

        // atau jika dana terkumpul berasal dari donasi:
        $danaTerkumpul = Donasi::where('status', 'Diterima')
            ->sum('nominal');

        $persenPembangunan = 0;

        if ($targetPembangunan > 0) {
            $persenPembangunan = round(($danaTerkumpul / $targetPembangunan) * 100);

            if ($persenPembangunan > 100) {
                $persenPembangunan = 100;
            }
        }

        return view('index', compact(
            'masjid',
            'kegiatan',
            'pengumuman',
            'galeri',
            'jumlahJamaah',
            'jumlahPengurus',
            'jumlahKegiatan',
            'totalDonasi',
            'totalPemasukan',
            'totalPengeluaran',
            'jadwalSholat',
            'saldoKas'
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

        $masjid = Masjid::first();

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
            'masjid',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'kegiatan',
            'pengumuman',
            'galeri',
        ));
    }

    public function donasi()
    {

        $masjid = Masjid::first();

        return view('home.donasi.index', compact('masjid'));
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

        $masjid = Masjid::first();

        return view('home.riwayat.index', compact(
            'donasi',
            'totalDonasi',
            'jumlahTransaksi',
            'donasiTerakhir',
            'distribusi',
            'allowedJenis',
            'masjid',
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

        Carbon::setLocale('id');

        $labelsBulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $labelsBulan[] = Carbon::create()->month($i)->translatedFormat('F');
        }

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
                'bulan' => $labelsBulan[$i - 1],
                'pemasukan' => $masuk,
                'pengeluaran' => $keluar,
                'saldo' => $masuk - $keluar
            ];
        }

        $masjid = Masjid::first();

        return view('home.keuangan.index', compact(
            'labelsBulan',
            'pemasukan',
            'pengeluaran',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'chartPemasukan',
            'chartPengeluaran',
            'rekapBulanan',
            'masjid',
        ));
    }
    public function kegiatan()
    {
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $masjid = Masjid::first();

        return view('home.kegiatan.index', compact('kegiatan', 'masjid'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $masjid = Masjid::first();

        return view('home.pengumuman.index', compact('pengumuman', 'masjid'));
    }

    public function publicKegiatan()
    {
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $masjid = Masjid::first();

        return view('kegiatan.index', compact('kegiatan', 'masjid'));
    }

    public function publicPengumuman()
    {
        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $masjid = Masjid::first();

        return view('pengumuman.index', compact('pengumuman', 'masjid'));
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

        $masjid = Masjid::first();

        return view('kegiatan.detail', compact(
            'kegiatan',
            'masjid',
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

        $masjid = Masjid::first();

        return view('home.kegiatan.detail', compact(
            'kegiatan',
            'masjid',
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

        $masjid = Masjid::first();

        return view('pengumuman.detail', compact(
            'pengumuman',
            'masjid',   
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

        $masjid = Masjid::first();

        return view('home.pengumuman.detail', compact(
            'pengumuman',
            'masjid',
            'pengumumanTerbaru'
        ));
    }
}
