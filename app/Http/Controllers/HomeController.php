<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

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
        return view('home.index');
    }

    public function donasi()
    {
        return view('home.donasi.index');
    }

    public function riwayat()
    {
        return view('home.riwayat.index');
    }

    public function kegiatan()
    {
        return view('home.kegiatan.index');
    }

    public function pengumuman()
    {
        return view('home.pengumuman.index');
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
}
