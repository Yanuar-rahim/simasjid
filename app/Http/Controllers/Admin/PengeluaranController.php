<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use App\Helper\ActivityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::with('user')
            ->latest('tanggal')
            ->paginate(10);

        return view('admin.keuangan.index', compact('pengeluaran'));
    }

    public function create()
    {
        return view('admin.keuangan.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $bukti = null;

        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti')
                ->store('pengeluaran', 'public');
        }

        Pengeluaran::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'bukti' => $bukti,
        ]);

        ActivityHelper::log(
            'Pengeluaran',
            'Menambahkan pengeluaran Rp ' . number_format($pengeluaran->nominal, 0, ',', '.'),
            'fa-money-bill-wave',
            'red'
        );

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return view(
            'admin.keuangan.pengeluaran.show',
            compact('pengeluaran')
        );
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view(
            'admin.keuangan.pengeluaran.edit',
            compact('pengeluaran')
        );
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'kategori',
            'nominal',
            'tanggal',
            'keterangan'
        ]);

        if ($request->hasFile('bukti')) {

            if ($pengeluaran->bukti) {
                Storage::disk('public')
                    ->delete($pengeluaran->bukti);
            }

            $data['bukti'] = $request
                ->file('bukti')
                ->store('pengeluaran', 'public');
        }

        $pengeluaran->update($data);

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->bukti) {
            Storage::disk('public')
                ->delete($pengeluaran->bukti);
        }

        $pengeluaran->delete();

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Pengeluaran berhasil dihapus');
    }
}
