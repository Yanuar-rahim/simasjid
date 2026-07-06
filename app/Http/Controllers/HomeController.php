<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pengumuman;

class HomeController extends Controller
{
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

        return view('index', compact('kegiatan', 'pengumuman'));
    }

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

        return view('kegiatan.detail', compact('kegiatan', 'lainnya'));
    }

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

        return view('pengumuman.detail', compact('pengumuman','pengumumanTerbaru'));
    }
}
