@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="dashboard-card">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center">
                        <i class="fa-solid fa-wallet text-3xl text-emerald-600"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">
                            Laporan Keuangan
                        </h1>
                        <p class="text-slate-500 mt-2">
                            Ringkasan pemasukan, pengeluaran, saldo kas, dan transaksi masjid.
                        </p>
                    </div>
                </div>
            </div>
            <a href="{{ route('laporan.index') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-800 hover:bg-slate-900 text-white transition">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
    {{-- Filter --}}
    <form
        method="GET"
        class="dashboard-card">
        <div class="flex justify-between">
            <div class="flex gap-5">
                <div>
                    <label class="font-medium text-slate-600">
                        Tanggal Mulai
                    </label>
                    <input
                        type="date"
                        name="mulai"
                        value="{{ $mulai }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="font-medium text-slate-600">
                        Tanggal Selesai
                    </label>
                    <input
                        type="date"
                        name="selesai"
                        value="{{ $selesai }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
            </div>
            <div class="flex items-end">
                <button
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl">
                    Filter
                </button>
            </div>
        </div>
    </form>
    {{-- Statistik --}}
    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">
        <div class="dashboard-card">
            <p class="text-slate-500">
                Total Pemasukan
            </p>
            <h2 class="mt-3 text-3xl font-bold text-emerald-600">
                Rp {{ number_format($totalPemasukan,0,',','.') }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500">
                Total Pengeluaran
            </p>
            <h2 class="mt-3 text-3xl font-bold text-red-600">
                Rp {{ number_format($totalPengeluaran,0,',','.') }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500">
                Saldo
            </p>
            <h2 class="mt-3 text-3xl font-bold text-blue-600">
                Rp {{ number_format($saldo,0,',','.') }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500">
                Total Transaksi
            </p>
            <h2 class="mt-3 text-3xl font-bold">
                {{ $listPemasukan->count() + $listPengeluaran->count() }}
            </h2>
        </div>
    </div>
    <div class="dashboard-card">
        <h2 class="text-xl font-bold mb-5">
            Data Pemasukan
        </h2>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-emerald-600">
                    <tr class="text-left text-white">
                        <th class="p-5">Tanggal</th>
                        <th>Sumber</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listPemasukan as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-5">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>
                        <td>
                            {{ $item->sumber }}
                        </td>
                        <td>
                            {{ $item->keterangan }}
                        </td>
                        <td class="font-semibold text-emerald-600">
                            Rp {{ number_format($item->nominal,0,',','.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-10 text-center text-slate-400">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="dashboard-card">
        <h2 class="text-xl font-bold mb-5">
            Data Pengeluaran
        </h2>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-emerald-600">
                    <tr class="text-left text-white">
                        <th class="p-5">Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listPengeluaran as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-5">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>
                        <td>
                            {{ $item->kategori }}
                        </td>
                        <td>
                            {{ $item->keterangan ?? '-' }}
                        </td>
                        <td class="font-semibold text-emerald-600">
                            Rp {{ number_format($item->nominal,0,',','.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-10 text-center text-slate-400">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex justify-end gap-4">
        <a
            href="{{ route('laporan.keuangan.pdf', request()->query()) }}"
            class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white">
            <i class="fa-solid fa-file-pdf mr-2"></i>
            Export PDF
        </a>
        <a
            href="{{ route('laporan.keuangan.excel', request()->query()) }}"
            class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">

            <i class="fa-solid fa-file-excel mr-2"></i>

            Export Excel

            </a>
    </div>
</div>
@endsection