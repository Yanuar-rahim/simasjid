@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header -->

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Detail Donasi

            </h1>

            <p class="text-slate-500 mt-2">

                Informasi lengkap transaksi donasi jamaah.

            </p>

        </div>

        <a
            href="{{ route('donasi.index') }}"
            class="px-6 py-3 rounded-2xl border border-slate-300 hover:bg-slate-100 transition">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- LEFT -->

        <div class="lg:col-span-2 space-y-8">

            <!-- Informasi Donatur -->

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

                <h2 class="text-2xl font-bold mb-8">

                    Informasi Donatur

                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <small class="text-slate-500">

                            Nama Donatur

                        </small>

                        <h3 class="font-semibold mt-2">

                            {{ $donasi->nama_donatur }}

                        </h3>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Jenis Donasi

                        </small>

                        <h3 class="font-semibold mt-2">

                            {{ $donasi->jenis_donasi }}

                        </h3>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Email

                        </small>

                        <h3 class="font-semibold mt-2">

                            {{ $donasi->email }}

                        </h3>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Nomor HP

                        </small>

                        <h3 class="font-semibold mt-2">

                            {{ $donasi->no_hp }}

                        </h3>

                    </div>

                </div>

            </div>

            <!-- Bukti Transfer -->

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="px-8 pt-8">

                    <h2 class="text-2xl font-bold">

                        Bukti Transfer

                    </h2>

                </div>

                @if($donasi->bukti_transfer)

                <img
                    src="{{ asset('storage/'.$donasi->bukti_transfer) }}"
                    class="w-full h-[550px] object-contain bg-slate-100 mt-6">

                @else

                <div class="h-96 flex items-center justify-center text-slate-400">

                    Tidak ada bukti transfer.

                </div>

                @endif

            </div>

            <!-- Doa -->

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

                <h2 class="text-2xl font-bold mb-6">

                    Doa / Pesan Donatur

                </h2>

                <div class="leading-8 text-slate-600">

                    {!! nl2br(e($donasi->doa ?: '-')) !!}

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 sticky top-24">

                <h2 class="text-2xl font-bold">

                    Ringkasan Donasi

                </h2>

                <!-- Nominal -->

                <div class="mt-8 rounded-3xl bg-emerald-50 p-8 text-center">

                    <small class="text-slate-500">

                        Nominal Donasi

                    </small>

                    <h2 class="text-4xl font-bold text-emerald-600 mt-3">

                        Rp {{ number_format($donasi->nominal,0,',','.') }}

                    </h2>

                </div>

                <div class="space-y-6 mt-8">

                    <div>

                        <small class="text-slate-500">

                            Metode

                        </small>

                        <h4 class="font-semibold mt-1">

                            {{ $donasi->metode }}

                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Tanggal

                        </small>

                        <h4 class="font-semibold mt-1">

                            {{ \Carbon\Carbon::parse($donasi->tanggal)->translatedFormat('d F Y') }}

                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Status

                        </small>

                        <br>

                        @if($donasi->status=='Menunggu')

                        <span class="inline-flex mt-2 px-5 py-2 rounded-full bg-yellow-100 text-yellow-700">

                            Menunggu

                        </span>

                        @elseif($donasi->status=='Diterima')

                        <span class="inline-flex mt-2 px-5 py-2 rounded-full bg-emerald-100 text-emerald-700">

                            Diterima

                        </span>

                        @else

                        <span class="inline-flex mt-2 px-5 py-2 rounded-full bg-red-100 text-red-700">

                            Ditolak

                        </span>

                        @endif

                    </div>

                </div>

                <a
                    href="{{ route('donasi.edit',$donasi->id) }}"
                    class="mt-10 w-full inline-flex justify-center items-center gap-2 px-6 py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white transition">

                    <i class="fa-solid fa-circle-check"></i>

                    Verifikasi Donasi

                </a>

            </div>

        </div>

    </div>

</div>

@endsection