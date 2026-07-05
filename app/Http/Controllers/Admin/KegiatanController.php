<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $kegiatan = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi' => 'required',
            'pemateri' => 'nullable',
            'status' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->except('gambar');

        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {

            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function store(Request $request)
    {

        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi' => 'required',
            'pemateri' => 'nullable',
            'status' => 'required',
            'deskripsi' => 'required',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'gambar' => $gambar,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'pemateri' => $request->pemateri,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {

            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
