<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\KeuanganExport;
use App\Exports\DonasiExport;
use App\Exports\PenggunaExport;
use App\Exports\KegiatanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kegiatan;
use App\Models\Masjid;
use App\Models\Donasi;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function keuangan(Request $request)
    {
        $mulai = $request->mulai;
        $selesai = $request->selesai;
        $pemasukan = Pemasukan::query();
        $pengeluaran = Pengeluaran::query();

        if ($mulai && $selesai) {
            $pemasukan->whereBetween('tanggal', [$mulai, $selesai]);
            $pengeluaran->whereBetween('tanggal', [$mulai, $selesai]);
        }

        $totalPemasukan = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $listPemasukan = $pemasukan
            ->latest('tanggal')
            ->get();

        $listPengeluaran = $pengeluaran
            ->latest('tanggal')
            ->get();

        return view(
            'admin.laporan.keuangan',
            compact(
                'mulai',
                'selesai',
                'totalPemasukan',
                'totalPengeluaran',
                'saldo',
                'listPemasukan',
                'listPengeluaran'
            )
        );
    }

    public function donasi(Request $request)
    {
        $mulai = $request->mulai;
        $selesai = $request->selesai;
        $status = $request->status;
        $jenis = $request->jenis;

        /*
        |--------------------------------------------------------------------------
        | Query Donasi
        |--------------------------------------------------------------------------
        */

        $donasi = Donasi::query();

        if ($mulai && $selesai) {
            $donasi->whereBetween('tanggal', [
                $mulai,
                $selesai
            ]);
        }

        if ($status) {
            $donasi->where('transaction_status', $status);
        }

        if ($jenis) {
            $donasi->where('jenis_donasi', $jenis);
        }

        $donasi = $donasi
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $query = Donasi::query();

        if ($mulai && $selesai) {
            $query->whereBetween('tanggal', [
                $mulai,
                $selesai
            ]);
        }

        if ($status) {
            $query->where('transaction_status', $status);
        }

        if ($jenis) {
            $query->where('jenis_donasi', $jenis);
        }

        $totalDonasi = $query->sum('nominal');

        $jumlahDonatur = $query
            ->distinct('email')
            ->count('email');

        $donasiBerhasil = (clone $query)
            ->where('transaction_status', 'settlement')
            ->count();

        $donasiPending = (clone $query)
            ->whereIn('transaction_status', [
                'pending',
                'challenge'
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Dropdown Jenis Donasi
        |--------------------------------------------------------------------------
        */

        $jenisDonasi = Donasi::select('jenis_donasi')
            ->distinct()
            ->pluck('jenis_donasi');

        return view('admin.laporan.donasi', compact(
            'donasi',
            'totalDonasi',
            'jumlahDonatur',
            'donasiBerhasil',
            'donasiPending',
            'jenisDonasi'
        ));
    }

    public function pengguna(Request $request)
    {
        $query = User::query();

        /*
    |--------------------------------------------------------------------------
    | Filter Keyword
    |--------------------------------------------------------------------------
    */

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        /*
    |--------------------------------------------------------------------------
    | Filter Role
    |--------------------------------------------------------------------------
    */

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        /*
    |--------------------------------------------------------------------------
    | Filter Online / Offline
    |--------------------------------------------------------------------------
    */

        if ($request->filled('status')) {
            if ($request->status == 'online') {
                $query->whereNotNull('last_seen')
                    ->where('last_seen', '>=', now()->subMinutes(5));
            } elseif ($request->status == 'offline') {
                $query->where(function ($q) {
                    $q->whereNull('last_seen')
                        ->orWhere('last_seen', '<', now()->subMinutes(5));
                });
            }
        }

        /*
    |--------------------------------------------------------------------------
    | Filter Tanggal
    |--------------------------------------------------------------------------
    */

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $query->whereBetween('created_at', [
                $request->mulai,
                $request->selesai
            ]);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.laporan.pengguna', [
            'users' => $users,
            'totalUser'   => User::count(),
            'totalAdmin'  => User::where('role', 'admin')->count(),
            'totalJamaah' => User::where('role', 'user')->count(),
            'online' => User::whereNotNull('last_seen')
                ->where('last_seen', '>=', now()->subMinutes(5))
                ->count(),

            'offline' => User::where(function ($q) {
                $q->whereNull('last_seen')
                    ->orWhere('last_seen', '<', now()->subMinutes(5));
            })->count(),

        ]);
    }

    public function kegiatan(Request $request)
    {
        $query = Kegiatan::query();

        /*
    |--------------------------------------------------------------------------
    | Filter Keyword
    |--------------------------------------------------------------------------
    */

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->keyword . '%');
            });
        }

        /*
    |--------------------------------------------------------------------------
    | Filter Pemateri
    |--------------------------------------------------------------------------
    */

        if ($request->filled('pemateri')) {
            $query->where(
                'pemateri',
                'like',
                '%' . $request->pemateri . '%'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        /*
    |--------------------------------------------------------------------------
    | Filter Tanggal
    |--------------------------------------------------------------------------
    */

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $query->whereBetween('tanggal', [
                $request->mulai,
                $request->selesai
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

        $kegiatan = $query
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

        return view('admin.laporan.kegiatan', [
            'kegiatan'      => $kegiatan,
            'totalKegiatan' => Kegiatan::count(),
            'totalAktif'    => Kegiatan::where('status', 'aktif')->count(),
            'totalDraft'    => Kegiatan::where('status', 'draft')->count(),
            'totalPemateri' => Kegiatan::distinct('pemateri')->count('pemateri'),
            'bulanIni'      => Kegiatan::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $mulai = $request->mulai;
        $selesai = $request->selesai;

        /*
    |--------------------------------------------------------------------------
    | Query Pemasukan
    |--------------------------------------------------------------------------
    */

        $pemasukan = Pemasukan::query();

        if ($mulai && $selesai) {
            $pemasukan->whereBetween('tanggal', [
                $mulai,
                $selesai
            ]);
        }

        $pemasukan = $pemasukan
            ->orderBy('tanggal')
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Query Pengeluaran
    |--------------------------------------------------------------------------
    */

        $pengeluaran = Pengeluaran::query();

        if ($mulai && $selesai) {
            $pengeluaran->whereBetween('tanggal', [
                $mulai,
                $selesai
            ]);
        }

        $pengeluaran = $pengeluaran
            ->orderBy('tanggal')
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Hitung Ringkasan
    |--------------------------------------------------------------------------
    */

        $totalPemasukan = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        /*
    |--------------------------------------------------------------------------
    | Profil Masjid
    |--------------------------------------------------------------------------
    */

        $masjid = Masjid::first();

        /*
    |--------------------------------------------------------------------------
    | Generate PDF
    |--------------------------------------------------------------------------
    */

        $pdf = Pdf::loadView('admin.laporan.pdf', [

            'masjid'            => $masjid,
            'mulai'             => $mulai,
            'selesai'           => $selesai,

            'pemasukan'         => $pemasukan,
            'pengeluaran'       => $pengeluaran,

            'totalPemasukan'    => $totalPemasukan,
            'totalPengeluaran'  => $totalPengeluaran,
            'saldo'             => $saldo,

        ]);

        $pdf->setPaper('A4', 'portrait');

        $namaFile = 'Laporan-Keuangan-';

        if ($mulai && $selesai) {

            $namaFile .=
                \Carbon\Carbon::parse($mulai)->format('d-m-Y')
                . '_sampai_' .
                \Carbon\Carbon::parse($selesai)->format('d-m-Y');
        } else {

            $namaFile .= now()->format('d-m-Y');
        }

        $namaFile .= '.pdf';

        return $pdf->download($namaFile);
    }

    public function exportExcel(Request $request)
    {
        $namaFile = 'Laporan-Keuangan-';
        if ($request->mulai && $request->selesai) {
            $namaFile .=
                \Carbon\Carbon::parse($request->mulai)->format('d-m-Y')
                . '_sampai_' .
                \Carbon\Carbon::parse($request->selesai)->format('d-m-Y');
        } else {
            $namaFile .= now()->format('d-m-Y');
        }

        $namaFile .= '.xlsx';
        return Excel::download(
            new KeuanganExport(
                $request->mulai,
                $request->selesai
            ),
            $namaFile
        );
    }

    public function exportDonasiExcel(Request $request)
    {
        return Excel::download(
            new DonasiExport(
                $request->mulai,
                $request->selesai,
                $request->status,
                $request->jenis
            ),

            'laporan-donasi.xlsx'
        );
    }

    public function exportDonasiPdf(Request $request)
    {
        $donasi = Donasi::query();

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $donasi->whereBetween('tanggal', [
                $request->mulai,
                $request->selesai
            ]);
        }

        if ($request->filled('status')) {
            $donasi->where('transaction_status', $request->status);
        }

        if ($request->filled('jenis')) {
            $donasi->where('jenis_donasi', $request->jenis);
        }

        $donasi = $donasi
            ->orderBy('tanggal')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf.donasi', [

            'masjid' => Masjid::first(),
            'donasi' => $donasi,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'totalDonasi' => $donasi->sum('nominal'),
            'tanggalCetak' => now(),

        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-donasi.pdf');
    }

    public function exportPenggunaExcel(Request $request)
    {
        return Excel::download(
            new PenggunaExport(
                $request->mulai,
                $request->selesai,
                $request->role,
                $request->status,
                $request->keyword
            ),

            'Laporan-Pengguna.xlsx'
        );
    }

    public function exportPenggunaPdf(Request $request)
    {
        $users = User::query();

        if ($request->filled('keyword')) {
            $users->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('role')) {
            $users->where('role', $request->role);
        }

        if ($request->filled('status')) {
            if ($request->status == 'online') {
                $users->whereNotNull('last_seen')
                    ->where('last_seen', '>=', now()->subMinutes(5));
            }

            if ($request->status == 'offline') {
                $users->where(function ($q) {
                    $q->whereNull('last_seen')
                        ->orWhere('last_seen', '<', now()->subMinutes(5));
                });
            }
        }

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $users->whereBetween('created_at', [
                $request->mulai,
                $request->selesai
            ]);
        }

        $users = $users->orderBy('name')->get();
        $pdf = Pdf::loadView('admin.laporan.pdf.pengguna', [
            'masjid' => Masjid::first(),
            'users' => $users,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'totalUser' => $users->count(),
            'totalAdmin' => $users->where('role', 'admin')->count(),
            'totalJamaah' => $users->where('role', 'user')->count(),
            'online' => $users->filter(function ($user) {
                return $user->last_seen && $user->last_seen >= now()->subMinutes(5);
            })->count(),
            'offline' => $users->filter(function ($user) {
                return !$user->last_seen || $user->last_seen < now()->subMinutes(5);
            })->count(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan-Pengguna.pdf');
    }

    public function exportKegiatanExcel(Request $request)
    {
        return Excel::download(
            new KegiatanExport(
                $request->mulai,
                $request->selesai,
                $request->status,
                $request->pemateri,
                $request->keyword
            ),
            'Laporan-Kegiatan.xlsx'
        );
    }

    public function exportKegiatanPdf(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                    ->orWhere('pemateri', 'like', '%' . $request->keyword . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('mulai') && $request->filled('selesai')) {
            $query->whereBetween('tanggal', [
                $request->mulai,
                $request->selesai
            ]);
        }

        $kegiatan = $query
            ->orderBy('tanggal')
            ->get();

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.kegiatan',
            [
                'masjid' => Masjid::first(),
                'kegiatan' => $kegiatan,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'tanggalCetak' => now(),
            ]
        )->setPaper('a4', 'portrait');

        return $pdf->download('laporan-kegiatan.pdf');
    }
}
