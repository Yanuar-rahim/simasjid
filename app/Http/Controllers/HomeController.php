<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class HomeController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        return view('index', compact('kegiatan'));
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
}
