<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityHelper;
use App\Helpers\UserLogHelper;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::latest();

        if ($request->filled('search')) {

            $query->where('judul', 'like', '%' . $request->search . '%');

        }

        $galeri = $query->paginate(12)->withQueryString();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'judul' => 'required|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'deskripsi' => 'nullable',
            'tanggal' => 'required|date',
            'status' => 'required|boolean',

        ]);

        $gambar = $request->file('gambar')
            ->store('galeri', 'public');

        Galeri::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        ActivityHelper::log(
            'Galeri',
            'Mengunggah foto ' . $request->judul,
            'fa-images',
            'blue'
        );

        UserLogHelper::store(
            'Mengunggah foto galeri',
            $request
        );

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([

            'judul' => 'required|max:255',

            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'deskripsi' => 'nullable',

            'tanggal' => 'required|date',

            'status' => 'required|boolean',

        ]);

        $gambar = $galeri->gambar;

        if ($request->hasFile('gambar')) {

            Storage::disk('public')->delete($galeri->gambar);

            $gambar = $request->file('gambar')
                ->store('galeri', 'public');
        }

        $galeri->update([

            'judul' => $request->judul,

            'gambar' => $gambar,

            'deskripsi' => $request->deskripsi,

            'tanggal' => $request->tanggal,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->gambar);

        $galeri->delete();

        return back()->with('success', 'Galeri berhasil dihapus.');
    }
}