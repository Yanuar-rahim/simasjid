<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
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
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        return view('home.index', compact(
            'kegiatan',
            'pengumuman'
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
