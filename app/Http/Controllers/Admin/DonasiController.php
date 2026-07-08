<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    /**
     * Daftar Donasi
     */
    public function index(Request $request)
    {
        $query = Donasi::query();

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('nama_donatur', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        $donasi = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalNominal = Donasi::where('status', 'Diterima')
            ->sum('nominal');

        $totalMenunggu = Donasi::where('status', 'Menunggu')
            ->count();

        $totalDiterima = Donasi::where('status', 'Diterima')
            ->count();

        $totalDitolak = Donasi::where('status', 'Ditolak')
            ->count();

        return view(
            'admin.donasi.index',
            compact(
                'donasi',
                'totalNominal',
                'totalMenunggu',
                'totalDiterima',
                'totalDitolak'
            )
        );
    }

    /**
     * Detail Donasi
     */
    public function show(Donasi $donasi)
    {
        return view('admin.donasi.show', compact('donasi'));
    }

    public function store(Request $request)
    {
        // nanti kita isi proses simpan donasi

        return back()->with('success','Donasi berhasil dikirim.');
    }

    /**
     * Form Verifikasi
     */
    public function edit(Donasi $donasi)
    {
        return view('admin.donasi.edit', compact('donasi'));
    }

    /**
     * Update Verifikasi
     */
    public function update(Request $request, Donasi $donasi)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
            'catatan_admin' => 'nullable|max:1000',
        ]);

        $donasi->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()
            ->route('donasi.index')
            ->with('success', 'Status donasi berhasil diperbarui.');
    }

    /**
     * Hapus Donasi
     */
    public function destroy(Donasi $donasi)
    {
        if (
            $donasi->bukti_transfer &&
            Storage::disk('public')->exists($donasi->bukti_transfer)
        ) {

            Storage::disk('public')->delete($donasi->bukti_transfer);
        }

        $donasi->delete();

        return redirect()
            ->route('donasi.index')
            ->with('success', 'Data donasi berhasil dihapus.');
    }
}
