<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\ActivityHelper;
use App\Models\Donasi;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::with('user')
            ->latest('tanggal')
            ->paginate(10);

        return view('admin.keuangan.index', compact('pemasukan'));
    }

    public function create()
    {
        $donasi = Donasi::where('status', 'Diterima')
            ->whereDoesntHave('pemasukan')
            ->latest()
            ->get();

        return view(
            'admin.keuangan.pemasukan.create',
            compact('donasi')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'donasi_id'   => 'nullable|exists:donasis,id',
            'sumber'      => 'required|string|max:255',
            'nominal'     => 'nullable|numeric|min:0',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
        ]);

        $nominal = $request->nominal;

        // Jika memilih data donasi, ambil nominal dari tabel donasi
        if ($request->filled('donasi_id')) {

            $sudahAda = Pemasukan::where(
                'donasi_id',
                $request->donasi_id
            )->exists();

            if ($sudahAda) {

                return back()
                    ->withErrors([
                        'donasi_id' => 'Donasi tersebut sudah tercatat sebagai pemasukan.'
                    ])
                    ->withInput();
            }
        }

        Pemasukan::create([
            'donasi_id'  => $request->donasi_id,
            'user_id'    => Auth::id(),
            'sumber'     => $request->sumber,
            'nominal'    => $nominal,
            'keterangan' => $request->keterangan,
            'tanggal'    => $request->tanggal,
        ]);

        ActivityHelper::log(
            'Pemasukan',
            'Menambahkan pemasukan Rp ' . number_format($request->nominal, 0, ',', '.'),
            'fa-wallet',
            'emerald'
        );

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Data pemasukan berhasil ditambahkan.');
    }

    public function show(Pemasukan $pemasukan)
    {
        return view(
            'admin.keuangan.pemasukan.show',
            compact('pemasukan')
        );
    }

    public function edit(Pemasukan $pemasukan)
    {
        return view(
            'admin.keuangan.pemasukan.edit',
            compact('pemasukan')
        );
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        $request->validate([
            'sumber' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable',
            'tanggal' => 'required|date',
        ]);

        $pemasukan->update([
            'sumber' => $request->sumber,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Pemasukan berhasil diperbarui');
    }

    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();

        return redirect()
            ->route('keuangan.index')
            ->with('success', 'Pemasukan berhasil dihapus');
    }
}
