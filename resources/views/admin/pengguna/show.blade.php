@extends('layouts.admin')
@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <!-- <a href="{{ route('users.index') }}"
                class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 mb-4">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a> -->
            <h1 class="text-3xl font-bold text-slate-800">
                Detail Pengguna
            </h1>
            <p class="text-slate-500 mt-2">
                Informasi lengkap akun pengguna SIMASJID.
            </p>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="flex gap-10">
            {{-- Foto --}}
            <div class="w-56 flex justify-center">
                @if($user->foto)
                <img
                    src="{{ asset('storage/'.$user->foto) }}"
                    class="w-48 h-48 rounded-3xl object-cover shadow-lg border-4 border-white transition duration-300 hover:scale-105">
                @else
                <div
                    class="w-48 h-48 rounded-3xl bg-emerald-100 flex items-center justify-center shadow">
                    <i class="fa-solid fa-user text-7xl text-emerald-600"></i>
                </div>
                @endif
            </div>
            {{-- Informasi --}}
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <h2 class="text-4xl font-bold text-slate-800">
                        {{ $user->name }}
                    </h2>
                    @if($user->role=='admin')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">
                        <i class="fa-solid fa-user-shield"></i>
                        Administrator
                    </span>
                    @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 font-semibold">
                        <i class="fa-solid fa-user"></i>
                        User
                    </span>
                    @endif
                </div>
                <div class="mt-4">
                    @if($user->online_status=='online')
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-emerald-700">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                        Online
                    </span>
                    @elseif($user->online_status=='recent')
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-yellow-50 px-4 py-2 text-yellow-700">
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        Baru saja aktif
                    </span>
                    @else
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-slate-600">
                        <span class="w-3 h-3 rounded-full bg-slate-400"></span>
                        Offline
                    </span>
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div>
                        <p class="text-sm text-slate-500">
                            Email
                        </p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $user->email }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">
                            Nomor HP
                        </p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $user->phone ?: '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">
                            Bergabung
                        </p>
                        <p class="mt-1 font-semibold">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">
                            Login Terakhir
                        </p>
                        <p class="mt-1 font-semibold">
                            @if($user->last_login_at)
                            {{ $user->last_login_at->diffForHumans() }}
                            @else
                            -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- =======================================================
    DETAIL INFORMASI
======================================================= --}}
    <div class="grid grid-cols-2 gap-8">
        {{-- Informasi Akun --}}
        <div class="dashboard-card">
            <h3 class="text-xl font-bold text-slate-800 mb-6">
                Informasi Akun
            </h3>
            <div class="space-y-5">
                <div>
                    <label class="text-sm text-slate-500">
                        Nama Lengkap
                    </label>
                    <div class="mt-1 font-semibold text-slate-800">
                        {{ $user->name }}
                    </div>
                </div>
                <div>
                    <label class="text-sm text-slate-500">
                        Email
                    </label>
                    <div class="mt-1">
                        {{ $user->email }}
                    </div>
                </div>
                <div>
                    <label class="text-sm text-slate-500">
                        Role
                    </label>
                    <div class="mt-2">
                        @if($user->role=='admin')
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                            Administrator
                        </span>
                        @else
                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                            User
                        </span>
                        @endif
                    </div>
                </div>
                <div>
                    <label class="text-sm text-slate-500">
                        Status
                    </label>
                    <div class="mt-2">
                        @if($user->online_status=='online')
                        <span class="inline-flex items-center gap-2 text-emerald-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online
                        </span>
                        @elseif($user->online_status=='recent')
                        <span class="inline-flex items-center gap-2 text-amber-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                            Baru saja aktif
                        </span>
                        @else
                        <span class="inline-flex items-center gap-2 text-slate-500">
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                            Offline
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Informasi Kontak --}}
        <div class="dashboard-card">
            <h3 class="text-xl font-bold text-slate-800 mb-6">
                Informasi Kontak
            </h3>
            <div class="space-y-5">
                <div>
                    <label class="text-sm text-slate-500">
                        Nomor HP
                    </label>
                    <div class="mt-1">
                        {{ $user->phone ?: '-' }}
                    </div>
                </div>
                <div>
                    <label class="text-sm text-slate-500">
                        Alamat
                    </label>
                    <div class="mt-1 leading-7">
                        {{ $user->address ?: '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- =======================================================
    INFORMASI SISTEM
======================================================= --}}
    <div class="dashboard-card">
        <h3 class="text-xl font-bold text-slate-800 mb-8">
            Informasi Sistem
        </h3>
        <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-8 gap-8">
            <div>
                <p class="text-sm text-slate-500">
                    ID Pengguna
                </p>
                <h4 class="mt-2 text-lg font-bold">
                    #{{ $user->id }}
                </h4>
            </div>
            <div>
                <p class="text-sm text-slate-500">
                    Bergabung
                </p>
                <h4 class="mt-2">
                    {{ $user->created_at->translatedFormat('d F Y') }}
                </h4>
            </div>
            <div>
                <p class="text-sm text-slate-500">
                    Login Terakhir
                </p>
                <h4 class="mt-2">
                    @if($user->last_login_at)
                    <div class="space-y-1">
                        <p class="font-semibold">
                            {{ $user->last_login_at->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ $user->last_login_at->diffForHumans() }}
                        </p>
                    </div>
                    @else
                    -
                    @endif
                </h4>
            </div>
            <div>
                <p class="text-sm text-slate-500">
                    Terakhir Aktif
                </p>
                <h4 class="mt-2">
                    @if($user->last_seen)
                    <div class="space-y-1">
                        <p class="font-semibold">
                            {{ $user->last_seen->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ $user->last_seen->diffForHumans() }}
                        </p>
                    </div>
                    @else
                    -
                    @endif
                </h4>
            </div>
        </div>
    </div>
    <div class="dashboard-card">
    <h3 class="text-xl font-bold mb-6">
        Aktivitas Terakhir
    </h3>
    <div class="space-y-4">
        @forelse($logs as $log)
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h4 class="font-semibold">
                    {{ $log->activity }}
                </h4>
                <p class="text-sm text-slate-500">
                    {{ $log->device }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-sm text-slate-500">
                    {{ $log->created_at->diffForHumans() }}
                </p>
                <p class="text-xs text-slate-400">
                    {{ $log->ip_address }}
                </p>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-10">
            Belum ada riwayat aktivitas.
        </div>
        @endforelse
    </div>
</div>
    {{-- =======================================================
    ACTION
======================================================= --}}
    <div class="flex justify-end gap-3">
        <a href="{{ route('users.index') }}"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-300 hover:bg-slate-100 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>
    @endsection

    @push('styles')

    <style>
        .dashboard-card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 15px 40px rgba(15, 23, 42, .05);
            border: 1px solid rgb(226 232 240);
        }
    </style>

    @endpush