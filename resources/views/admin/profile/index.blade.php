@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Profil Administrator
            </h1>
            <p class="text-slate-500 mt-2">
                Kelola informasi akun administrator serta keamanan login.
            </p>
        </div>
    </div>
    <div class="grid lg:grid-cols-3 gap-8 mt-8">
        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="dashboard-card text-center">
                <div class="flex justify-center">
                    @if($user->foto)
                    <img
                        src="{{ asset('storage/' . $user->foto) }}"
                        alt="{{ $user->name }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10b981&color=ffffff&size=300"
                        alt="{{ $user->name }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    @endif
                </div>
                <h2 class="mt-6 text-2xl font-bold text-slate-800">
                    {{ $user->name }}
                </h2>
                <p class="text-slate-500 mt-2">
                    Administrator SIMASJID
                </p>
                @if($user->last_seen && $user->last_seen >= now()->subMinutes(5))
                <span
                    class="inline-flex items-center gap-2 mt-5 px-4 py-2 rounded-full bg-green-100 text-green-700">
                    <span class="w-2 h-2 rounded-full bg-green-600"></span>
                    Online
                </span>
                @else
                <span
                    class="inline-flex items-center gap-2 mt-5 px-4 py-2 rounded-full bg-slate-200 text-slate-700">
                    <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                    Offline
                </span>
                @endif
                <div class="mt-8 pt-6 space-y-3">
                    <a
                        href="{{ route('admin.profile.edit') }}"
                        class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                        <i class="fa-solid fa-user-pen"></i>
                        Edit Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="w-full inline-flex justify-center items-center gap-2 px-4 py-3 rounded-xl border border-red-300 text-red-600 hover:bg-red-50">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Content --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="dashboard-card">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-id-card text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">
                            Informasi Akun
                        </h3>
                        <p class="text-slate-500 text-sm">
                            Informasi dasar administrator.
                        </p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm text-slate-500">
                            Nama Lengkap
                        </label>
                        <p class="mt-2 text-lg font-semibold text-slate-800">
                            {{ $user->name }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-slate-500">
                            Role
                        </label>
                        <p class="mt-2">
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 font-semibold">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-slate-500">
                            Email
                        </label>
                        <p class="mt-2 text-slate-800">
                            {{ $user->email }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-slate-500">
                            Bergabung Sejak
                        </label>
                        <p class="mt-2 text-slate-800">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- Statistik Akun --}}
<div class="dashboard-card">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-slate-800">
            Statistik Akun
        </h3>
        <i class="fa-solid fa-chart-pie text-indigo-600 text-xl"></i>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
        {{-- Role --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">
                        Role
                    </p>
                    <h4 class="mt-2 text-xl font-bold text-slate-800">
                        {{ ucfirst($user->role) }}
                    </h4>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                    <i class="fa-solid fa-user-shield text-emerald-600"></i>
                </div>
            </div>
        </div>
        {{-- Status --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">
                        Status
                    </p>
                    <h4 class="mt-2 text-xl font-bold">
                        @if($user->last_seen && $user->last_seen >= now()->subMinutes(5))
                            <span class="text-green-600">
                                Online
                            </span>
                        @else
                            <span class="text-slate-600">
                                Offline
                            </span>
                        @endif
                    </h4>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                </div>
            </div>
        </div>
        {{-- Terdaftar --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">
                        Terdaftar
                    </p>
                    <h4 class="mt-2 text-lg font-bold text-slate-800">
                        {{ $user->created_at->translatedFormat('d F Y') }}
                    </h4>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-blue-600"></i>
                </div>
            </div>
        </div>
    </div>
</div>
            <div class="dashboard-card">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-slate-800">
            Aktivitas Akun
        </h3>
        <i class="fa-solid fa-chart-line text-emerald-600 text-xl"></i>
    </div>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-slate-500 text-sm">
                Bergabung Sejak
            </p>
            <h4 class="text-lg font-bold mt-2">
                {{ $user->created_at->translatedFormat('d F Y') }}
            </h4>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-slate-500 text-sm">
                Login Terakhir
            </p>
            <h4 class="text-lg font-bold mt-2">
                @if($user->last_login_at)
                    {{ $user->last_login_at->diffForHumans() }}
                @else
                    -
                @endif
            </h4>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-slate-500 text-sm">
                Status Akun
            </p>
            <h4 class="text-lg font-bold mt-2">
                @if($user->last_seen && $user->last_seen >= now()->subMinutes(5))
                    <span class="text-green-600">
                        Online
                    </span>
                @else
                    <span class="text-slate-600">
                        Offline
                    </span>
                @endif
            </h4>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <p class="text-slate-500 text-sm">
                Email Terverifikasi
            </p>
            <h4 class="text-lg font-bold mt-2">
                @if($user->email_verified_at)
                    <span class="text-green-600">
                        Sudah Diverifikasi
                    </span>
                @else
                    <span class="text-red-500">
                        Belum
                    </span>
                @endif
            </h4>
        </div>
    </div>
</div>
            {{-- Informasi Kontak --}}
            <div class="dashboard-card">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <i class="fa-solid fa-address-book text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">
                            Informasi Kontak
                        </h3>
                        <p class="text-sm text-slate-500">
                            Data kontak administrator.
                        </p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm text-slate-500">
                            Nomor Telepon
                        </label>
                        <p class="mt-2 text-slate-800">
                            @if($user->phone)
                            {{ $user->phone }}
                            @else
                            <span class="italic text-slate-400">
                                Belum diisi
                            </span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-slate-500">
                            Status Email
                        </label>
                        <p class="mt-2">
                            @if($user->email_verified_at)
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                                Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                Belum Diverifikasi
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-slate-500">
                            Alamat
                        </label>
                        <p class="mt-2 text-slate-800 leading-7">
                            @if($user->address)
                            {{ $user->address }}
                            @else
                            <span class="italic text-slate-400">
                                Belum diisi
                            </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            {{-- Keamanan Akun --}}
            <div class="dashboard-card">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                            <i class="fa-solid fa-shield-halved text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">
                                Keamanan Akun
                            </h3>
                            <p class="text-sm text-slate-500">
                                Pengaturan keamanan administrator.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('admin.profile.password') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white transition">
                        <i class="fa-solid fa-key"></i>
                        Ubah Password
                    </a>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm text-slate-500">
                            Password
                        </label>
                        <p class="mt-2 text-lg tracking-[6px] text-slate-800">
                            ••••••••••••
                        </p>
                        <span class="text-xs text-slate-400">
                            Demi keamanan password tidak ditampilkan.
                        </span>
                    </div>
                    <div>
                        <label class="text-sm text-slate-500">
                            Email Terverifikasi
                        </label>
                        <p class="mt-2">
                            @if($user->email_verified_at)
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                                Sudah Diverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                Belum Diverifikasi
                            </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection