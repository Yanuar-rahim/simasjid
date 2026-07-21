@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    <!-- Header -->
    <div class="dashboard-card">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-amber-100 flex items-center justify-center">
                        <i class="fa-solid fa-users text-3xl text-amber-600"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">
                            Laporan Pengguna
                        </h1>
                        <p class="text-slate-500 mt-2">
                            Daftar seluruh pengguna sistem SIMASJID.
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
                    href="{{ route('laporan.pengguna.excel', request()->query()) }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    <i class="fa-solid fa-file-excel"></i>
                    Export Excel
                </a>
                <a
                    href="{{ route('laporan.pengguna.pdf', request()->query()) }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white">
                    <i class="fa-solid fa-file-pdf"></i>
                    Export PDF
                </a>
            </div>
        </div>
    </div>
    <div class="grid md:grid-cols-5 gap-5">
        <div class="dashboard-card">
            <p class="text-slate-500 text-sm">
                Total Akun
            </p>
            <h2 class="text-3xl font-bold mt-3">
                {{ $totalUser }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500 text-sm">
                Admin
            </p>
            <h2 class="text-3xl font-bold mt-3 text-indigo-600">
                {{ $totalAdmin }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500 text-sm">
                User
            </p>
            <h2 class="text-3xl font-bold mt-3 text-emerald-600">
                {{ $totalJamaah }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500 text-sm">
                Online
            </p>
            <h2 class="text-3xl font-bold mt-3 text-green-600">
                {{ $online }}
            </h2>
        </div>
        <div class="dashboard-card">
            <p class="text-slate-500 text-sm">
                Offline
            </p>
            <h2 class="text-3xl font-bold mt-3 text-red-600">
                {{ $offline }}
            </h2>
        </div>
    </div>
    <div class="dashboard-card">
        <form method="GET">
            <div class="grid md:grid-cols-5 gap-5">
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
                <div>
                    <label class="block text-sm mb-2">
                        Role
                    </label>
                    <select
                        name="role"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                        <option value="">Semua</option>
                        <option value="admin">Admin</option>
                        <option value="user">Jamaah</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm mb-2">
                        Status
                    </label>
                    <select
                        name="status"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                        <option value="">Semua</option>
                        <option
                            value="online"
                            {{ request('status')=='online' ? 'selected' : '' }}>
                            Online
                        </option>
                        <option
                            value="offline"
                            {{ request('status')=='offline' ? 'selected' : '' }}>
                            Offline
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm mb-2">
                        Keyword
                    </label>
                    <input
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Nama / Email"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">
                </div>
            </div>
            <div class="mt-5 flex justify-end gap-3">
                <button
                    class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    Cari
                </button>
                <a
                    href="{{ route('laporan.user') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300">
                    Reset
                </a>
            </div>
        </form>
    </div>
    <div class="dashboard-card overflow-hidden">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-emerald-600">
                    <tr class="text-white">
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Nama</th>
                        <th class="px-5 py-4 text-left">Email</th>
                        <th class="px-5 py-4 text-center">Role</th>
                        <th class="px-5 py-4 text-center">Status Aktifitas</th>
                        <th class="px-5 py-4 text-center">Terdaftar</th>
                        <th class="px-5 py-4 text-center">Terakhir Dilihat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4">
                            {{ $users->firstItem() + $loop->index }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $user->email }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($user->role=='admin')
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm">
                                Adminitrator
                            </span>
                            @else
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                                User
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($user->last_seen && $user->last_seen >= now()->subMinutes(5))
                            <span
                                class="inline-flex rounded-full items-center gap-2 text-emerald-600 text-sm bg-emerald-100 px-3 py-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Online
                            </span>
                            @else
                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-slate-200 text-slate-600 text-sm">
                                Offline
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            {{ $user->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($user->last_login_at)
                            {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td
                            colspan="7"
                            class="text-center py-16 text-slate-400">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection