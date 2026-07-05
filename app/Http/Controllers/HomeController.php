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
}