@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Two-Factor Authentication
        </h1>
        <p class="text-slate-500 mt-2">
            Tingkatkan keamanan akun administrator menggunakan Google Authenticator.
        </p>
    </div>
    @if(session('success'))
    <div class="rounded-2xl bg-green-50 border border-green-200 p-4 text-green-700">
        {{ session('success') }}
    </div>
    @endif
    {{-- STATUS --}}
    <div class="dashboard-card">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold">
                    Status Keamanan
                </h2>
                <p class="text-slate-500 mt-2">
                    Status Two-Factor Authentication akun Anda.
                </p>
            </div>
            @if($user->two_factor_confirmed_at)
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">
                <i class="fa-solid fa-circle-check"></i>
                Aktif
            </span>
            @else
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                <i class="fa-solid fa-circle-exclamation"></i>
                Belum Aktif
            </span>
            @endif
        </div>
    </div>
    {{-- QR CODE --}}
    <div class="grid lg:grid-cols-2 gap-8">
        <div class="dashboard-card">
            <h2 class="text-xl font-bold mb-6">
                Scan QR Code
            </h2>
            <div class="flex justify-center">
                {!! $qrCode !!}
            </div>
            <p class="text-center mt-6 text-slate-500">
                Scan menggunakan aplikasi
                <strong>Google Authenticator</strong>
            </p>
        </div>
        {{-- Secret --}}
        <div class="dashboard-card">
            <h2 class="text-xl font-bold">
                Secret Key
            </h2>
            <p class="text-slate-500 mt-2">
                Jika QR Code tidak dapat dipindai, gunakan Secret Key berikut.
            </p>
            <div class="mt-6 rounded-2xl bg-slate-100 p-5 font-mono break-all text-lg">
                {{ $secret }}
            </div>
        </div>
    </div>
    {{-- Aktivasi --}}
    @if(!$user->two_factor_confirmed_at)
    <div class="dashboard-card">
        <h2 class="text-xl font-bold">
            Konfirmasi Aktivasi
        </h2>
        <p class="text-slate-500 mt-2">
            Setelah scan QR Code, masukkan kode OTP yang muncul pada Google Authenticator.
        </p>
        <form
            method="POST"
            action="{{ route('admin.2fa.enable') }}"
            class="mt-8">
            @csrf
            <div>
                <label class="font-medium">
                    Kode OTP
                </label>
                <input
                    type="text"
                    name="code"
                    maxlength="6"
                    autocomplete="off"
                    placeholder="123456"
                    class="mt-3 w-full rounded-2xl border border-slate-300 px-5 py-3 text-center text-2xl tracking-[10px] focus:border-emerald-600 focus:ring-emerald-600">
                @error('code')
                <p class="text-red-500 mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <button
                class="mt-8 w-full rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white py-3 font-semibold">
                <i class="fa-solid fa-shield-halved mr-2"></i>
                Aktifkan Two-Factor Authentication
            </button>
        </form>
    </div>
    @else
    {{-- Disable --}}
    <div class="dashboard-card">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold">
                    Two-Factor Authentication Aktif
                </h2>
                <p class="text-slate-500 mt-2">
                    Setiap login akan meminta kode OTP dari Google Authenticator.
                </p>
            </div>
            <form
                method="POST"
                action="{{ route('admin.2fa.disable') }}">
                @csrf
                <button
                    class="px-6 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white">
                    <i class="fa-solid fa-trash"></i>
                    Nonaktifkan
                </button>
            </form>
        </div>
    </div>
    @endif
</div>

@endsection