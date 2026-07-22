@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="dashboard-card">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-days text-3xl text-purple-600"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">
                            Laporan Kegiatan
                        </h1>
                        <p class="text-slate-500 mt-2">
                            Daftar seluruh kegiatan Masjid beserta informasi pelaksanaannya.
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <a
                    href="{{ route('laporan.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-800 hover:bg-slate-900 text-white transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
                <a
                    href="{{ route('laporan.kegiatan.excel', request()->query()) }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Excel
                </a>
                <a
                    href="{{ route('laporan.kegiatan.pdf', request()->query()) }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white">
                    <i class="fa-solid fa-file-pdf"></i>
                    Export PDF
                </a>
            </div>
        </div>
    </div>
    {{-- Statistik --}}
    <div class="grid md:grid-cols-5 gap-5">
        <div class="dashboard-card">
            <p class="text-sm text-slate-500">
                Total Kegiatan
            </p>
            <h2 class="text-3xl font-bold mt-3">
                {{ $totalKegiatan }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-sm text-slate-500">
                Aktif
            </p>
            <h2 class="text-3xl font-bold text-green-600 mt-3">
                {{ $aktif }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-sm text-slate-500">
                Draft
            </p>
            <h2 class="text-3xl font-bold text-yellow-600 mt-3">
                {{ $draft }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-sm text-slate-500">
                Minggu Ini
            </p>
            <h2 class="text-3xl font-bold text-blue-600 mt-3">
                {{ $mingguIni }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-sm text-slate-500">
                Bulan Ini
            </p>
            <h2 class="text-3xl font-bold text-indigo-600 mt-3">
                {{ $bulanIni }}
            </h2>
        </div>
    </div>
    {{-- Filter --}}
    <div class="dashboard-card">
        <form method="GET">
            <div class="grid md:grid-cols-5 gap-5">
                {{-- Tanggal Mulai --}}
                <div>
                    <label class="block text-sm mb-2">
                        Mulai
                    </label>
                    <input
                        type="date"
                        name="mulai"
                        value="{{ request('mulai') }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
                {{-- Tanggal Selesai --}}
                <div>
                    <label class="block text-sm mb-2">
                        Selesai
                    </label>
                    <input
                        type="date"
                        name="selesai"
                        value="{{ request('selesai') }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
                {{-- Status --}}
                <div>
                    <label class="block text-sm mb-2">
                        Status
                    </label>
                    <select
                        name="status"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                        <option value="">Semua Status</option>
                        <option
                            value="aktif"
                            @selected(request('status')=='aktif' )>
                            Aktif
                        </option>
                        <option
                            value="draft"
                            @selected(request('status')=='draft' )>
                            Draft
                        </option>
                    </select>
                </div>
                {{-- Pemateri --}}
                <div>
                    <label class="block text-sm mb-2">
                        Pemateri
                    </label>
                    <input
                        type="text"
                        name="pemateri"
                        value="{{ request('pemateri') }}"
                        placeholder="Nama Pemateri"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
                {{-- Keyword --}}
                <div>
                    <label class="block text-sm mb-2">
                        Keyword
                    </label>
                    <input
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Judul / Lokasi"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
            </div>
            <div class="mt-5 flex justify-end gap-3">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>
                    Cari
                </button>
                <a
                    href="{{ route('laporan.kegiatan') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">
                    Reset
                </a>
            </div>
        </form>
    </div>
    {{-- Tabel Kegiatan --}}
    <div class="dashboard-card overflow-hidden">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-emerald-600">
                    <tr class="text-white">
                        <th class="px-5 py-4 text-left">
                            No
                        </th>
                        <th class="px-5 py-4 text-left">
                            Judul
                        </th>
                        <th class="px-5 py-4 text-left">
                            Pemateri
                        </th>
                        <th class="px-5 py-4 text-left">
                            Lokasi
                        </th>
                        <th class="px-5 py-4 text-center">
                            Tanggal
                        </th>
                        <th class="px-5 py-4 text-center">
                            Jam
                        </th>
                        <th class="px-5 py-4 text-center">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4">
                            {{ $kegiatan->firstItem() + $loop->index }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-800">
                                {{ $item->judul }}
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            {{ $item->pemateri }}
                        </td>
                        <td class="px-5 py-4">
                            {{ $item->lokasi }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            {{ $item->jam }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($item->status == 'Aktif')
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                Aktif
                            </span>
                            @else
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                Draft
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td
                            colspan="7"
                            class="text-center py-16 text-slate-400">
                            Belum ada data kegiatan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $kegiatan->links() }}
        </div>
    </div>
</div>
@endsection