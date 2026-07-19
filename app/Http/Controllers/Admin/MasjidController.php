<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masjid;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    /**
     * Halaman Profil Masjid
     */
    public function index()
    {
        $masjid = Masjid::first();

        return view('admin.masjid.profile', compact('masjid'));
    }

    /**
     * Simpan / Update Profil Masjid
     */
    public function save(Request $request)
    {
        $request->validate([
            'nama_masjid'  => 'required|max:255',
            'alamat'       => 'required',
            'telepon'      => 'nullable|max:30',
            'email'        => 'nullable|email|max:255',
            'ketua_takmir' => 'nullable|max:255',
            'visi'         => 'nullable',
            'misi'         => 'nullable',
            'google_maps'  => 'nullable',
        ]);

        $masjid = Masjid::first();

        if (!$masjid) {

            Masjid::create([
                'nama_masjid'  => $request->nama_masjid,
                'alamat'       => $request->alamat,
                'telepon'      => $request->telepon,
                'email'        => $request->email,
                'ketua_takmir' => $request->ketua_takmir,
                'visi'         => $request->visi,
                'misi'         => $request->misi,
                'google_maps'  => $request->google_maps,
            ]);

            return back()->with('success', 'Profil masjid berhasil dibuat.');
        }

        $masjid->update([
            'nama_masjid'  => $request->nama_masjid,
            'alamat'       => $request->alamat,
            'telepon'      => $request->telepon,
            'email'        => $request->email,
            'ketua_takmir' => $request->ketua_takmir,
            'visi'         => $request->visi,
            'misi'         => $request->misi,
            'google_maps'  => $request->google_maps,
        ]);

        return back()->with('success', 'Profil masjid berhasil diperbarui.');
    }
}