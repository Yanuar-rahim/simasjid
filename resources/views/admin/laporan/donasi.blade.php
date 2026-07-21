@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="dashboard-card">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-hand-holding-heart text-3xl text-blue-600"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">
                            Laporan Donasi
                        </h1>
                        <p class="text-slate-500 mt-2">
                            Ringkasan seluruh transaksi donasi yang masuk ke sistem.
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
    {{-- Statistik --}}
    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Total Donasi
                    </p>
                    <h2 class="text-3xl font-bold mt-3 text-emerald-600">
                        Rp {{ number_format($totalDonasi,0,',','.') }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Jumlah Donatur
                    </p>
                    <h2 class="text-3xl font-bold mt-3">
                        {{ $jumlahDonatur }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Donasi Berhasil
                    </p>
                    <h2 class="text-3xl font-bold mt-3 text-emerald-600">
                        {{ $donasiBerhasil }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Donasi Pending
                    </p>
                    <h2 class="text-3xl font-bold mt-3 text-amber-500">
                        {{ $donasiPending }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
        </div>
    </div>
    {{-- Filter --}}
    <div class="dashboard-card">
        <form
            method="GET"
            action="{{ route('laporan.donasi') }}">
            <div class="grid lg:grid-cols-5 gap-5">
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Dari Tanggal
                    </label>
                    <input
                        type="date"
                        name="mulai"
                        value="{{ request('mulai') }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Sampai
                    </label>
                    <input
                        type="date"
                        name="selesai"
                        value="{{ request('selesai') }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Status
                    </label>
                    <select
                        name="status"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                        <option value="">
                            Semua
                        </option>
                        <option value="settlement"
                            @selected(request('status')=='settlement')>
                            Berhasil
                        </option>
                        <option value="pending"
                            @selected(request('status')=='pending')>
                            Pending
                        </option>
                        <option value="expire"
                            @selected(request('status')=='expire')>
                            Expired
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Jenis Donasi
                    </label>
                    <select
                        name="jenis"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                        <option value="">
                            Semua
                        </option>
                        @foreach($jenisDonasi as $item)
                        <option
                            value="{{ $item }}"
                            @selected(request('jenis')==$item)>
                            {{ $item }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl py-3">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
    {{-- ==========================
    TABEL DONASI
========================== --}}
<div class="dashboard-card">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Data Donasi
            </h2>
            <p class="text-slate-500 mt-1">
                Daftar seluruh transaksi donasi.
            </p>
        </div>
        <div class="flex gap-3">
            <a
                href="{{ route('laporan.donasi.excel',request()->query()) }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                <i class="fa-solid fa-file-excel"></i>
                Export Excel
            </a>
            <a
                href="{{ route('laporan.donasi.pdf',request()->query()) }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white">
                <i class="fa-solid fa-file-pdf"></i>
                Export PDF
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="py-4 text-left">No</th>
                    <th class="py-4 text-left">Tanggal</th>
                    <th class="py-4 text-left">Donatur</th>
                    <th class="py-4 text-left">Jenis</th>
                    <th class="py-4 text-left">Metode</th>
                    <th class="py-4 text-right">Nominal</th>
                    <th class="py-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donasi as $item)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="py-4">
                        {{ $loop->iteration + ($donasi->currentPage()-1) * $donasi->perPage() }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                    </td>
                    <td>
                        <div>
                            <div class="font-semibold">
                                {{ $item->nama_donatur }}
                            </div>
                            <div class="text-sm text-slate-500">
                                {{ $item->email }}
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $item->jenis_donasi }}
                    </td>
                    <td>
                        {{ strtoupper($item->metode) }}
                    </td>
                    <td class="text-right font-semibold text-emerald-600">
                        Rp {{ number_format($item->nominal,0,',','.') }}
                    </td>
                    <td class="text-center">
                        @if($item->transaction_status == 'settlement')
                        <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 px-3 py-1 text-xs font-semibold">
                            Berhasil
                        </span>
                        @elseif($item->transaction_status == 'pending')
                        <span class="inline-flex items-center rounded-full bg-amber-100 text-amber-700 px-3 py-1 text-xs font-semibold">
                            Pending
                        </span>
                        @elseif($item->transaction_status == 'expire')
                        <span class="inline-flex items-center rounded-full bg-red-100 text-red-700 px-3 py-1 text-xs font-semibold">
                            Expired
                        </span>
                        @else
                        <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-600 px-3 py-1 text-xs font-semibold">
                            {{ ucfirst($item->transaction_status) }}
                        </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-slate-500">
                        Belum ada data donasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $donasi->links() }}
    </div>
</div>
</div>

@endsection