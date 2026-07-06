<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $pengumuman = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'judul' => 'required|max:255',

            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:4096',

            'kategori' => 'required|max:100',

            'status' => 'required',

            'isi' => 'required'

        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                ->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'gambar' => $gambar,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'isi' => $request->isi
        ]);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'kategori' => 'required|max:100',
            'status' => 'required',
            'isi' => 'required',
        ]);

        $data = $request->except('gambar');

        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {

            if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {

                Storage::disk('public')->delete($pengumuman->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        // Hapus gambar jika ada
        if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        // Hapus data
        $pengumuman->delete();

        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
