@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Laporan
            </h1>
            <p class="text-slate-500 mt-2">
                Kelola seluruh laporan sistem dan ekspor ke PDF maupun Excel.
            </p>
        </div>
    </div>
    {{-- Statistik --}}
    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Jenis Laporan
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        4
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Export PDF
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        <i class="fa-solid fa-file-pdf text-red-500"></i>
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-file-export"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Export Excel
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        <i class="fa-solid fa-file-excel text-green-600"></i>
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-table"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Status
                    </p>
                    <h2 class="mt-3 text-lg font-bold text-emerald-600">
                        Siap Digunakan
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>
    </div>
    {{-- Card Menu --}}
    <div class="grid lg:grid-cols-2 gap-8">
        {{-- Keuangan --}}
        <a href="{{ route('laporan.keuangan') }}"
            class="group dashboard-card hover:-translate-y-2 transition duration-300">
            <div class="flex items-center gap-5">
                <div
                    class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-600 transition">
                    <i class="fa-solid fa-wallet text-3xl text-emerald-600 group-hover:text-white"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">
                        Laporan Keuangan
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Ringkasan pemasukan, pengeluaran, saldo, serta ekspor laporan.
                    </p>
                </div>
            </div>
        </a>
        {{-- Donasi --}}
        <a href="{{ route('laporan.donasi') }}"
            class="group dashboard-card hover:-translate-y-2 transition duration-300">
            <div class="flex items-center gap-5">
                <div
                    class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center group-hover:bg-blue-600 transition">
                    <i class="fa-solid fa-hand-holding-heart text-3xl text-blue-600 group-hover:text-white"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">
                        Laporan Donasi
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Seluruh transaksi donasi beserta status pembayaran.
                    </p>
                </div>
            </div>
        </a>
        {{-- User --}}
        <a href="{{ route('laporan.user') }}"
            class="group dashboard-card hover:-translate-y-2 transition duration-300">
            <div class="flex items-center gap-5">
                <div
                    class="w-16 h-16 rounded-2xl bg-amber-100 flex items-center justify-center group-hover:bg-amber-500 transition">
                    <i class="fa-solid fa-users text-3xl text-amber-600 group-hover:text-white"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">
                        Laporan Pengguna
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Data administrator dan seluruh pengguna sistem.
                    </p>
                </div>
            </div>
        </a>
        {{-- Kegiatan --}}
        <a href="{{ route('laporan.kegiatan') }}"
            class="group dashboard-card hover:-translate-y-2 transition duration-300">
            <div class="flex items-center gap-5">
                <div
                    class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center group-hover:bg-purple-600 transition">
                    <i class="fa-solid fa-calendar-days text-3xl text-purple-600 group-hover:text-white"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">
                        Laporan Kegiatan
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Seluruh data kegiatan yang telah dibuat.
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection