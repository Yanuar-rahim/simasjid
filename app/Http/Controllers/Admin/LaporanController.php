<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\KeuanganExport;
use App\Exports\DonasiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Masjid;
use App\Models\Donasi;
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
    public function user()
    {
        return view('admin.laporan.user');
    }

    public function kegiatan()
    {
        return view('admin.laporan.kegiatan');
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
}
