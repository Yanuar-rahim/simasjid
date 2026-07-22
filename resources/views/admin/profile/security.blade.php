@extends('layouts.admin')

@section('content')

<div class="dashboard-card">
    <h1 class="text-3xl font-bold">
        Two-Factor Authentication
    </h1>
    <p class="text-slate-500 mt-3">
        Lindungi akun administrator menggunakan Google Authenticator.
    </p>
    <div class="mt-8">
        @if(!$user->two_factor_secret)
        <form action="{{ route('admin.2fa.enable') }}" method="POST">
            @csrf
            <button
                class="px-6 py-3 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">
                Aktifkan Two-Factor Authentication
            </button>
        </form>
        @else
        <div
            class="rounded-xl bg-green-50 border border-green-200 p-5">
            <p class="font-semibold text-green-700">
                @if(!$user->two_factor_secret)
            <form action="{{ route('admin.2fa.enable') }}" method="POST">
                @csrf
                <button
                    class="px-6 py-3 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">
                    <i class="fa-solid fa-shield-halved mr-2"></i>
                    Aktifkan Two-Factor Authentication
                </button>
            </form>
            @else
            <div class="grid lg:grid-cols-2 gap-8 mt-8">
                <div class="dashboard-card text-center">
                    <h3 class="text-xl font-bold mb-6">
                        Scan QR Code
                    </h3>
                    <div class="flex justify-center">
                        {!! $qrCode !!}
                    </div>
                    <p class="mt-6 text-slate-500">
                        Scan menggunakan
                        <strong>Google Authenticator</strong>
                    </p>
                </div>
                <div class="dashboard-card">
                    <h3 class="text-xl font-bold">
                        Secret Key
                    </h3>
                    <div
                        class="mt-5 rounded-xl bg-slate-100 p-4 font-mono text-lg break-all">
                        {{ $secret }}
                    </div>
                    <p class="mt-4 text-slate-500">
                        Gunakan Secret Key apabila QR Code tidak dapat dipindai.
                    </p>
                </div>
            </div>
            @endif
            </p>
            <p class="mt-3">
                Langkah berikutnya adalah scan QR Code menggunakan Google Authenticator.
            </p>
        </div>
        @endif
    </div>
</div>

@endsection