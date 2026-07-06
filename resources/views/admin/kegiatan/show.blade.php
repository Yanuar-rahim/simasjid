@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Detail Kegiatan

            </h1>

            <p class="text-slate-500 mt-2">

                Informasi lengkap mengenai kegiatan masjid.

            </p>

        </div>

        <!-- <a href="{{ route('kegiatan.index') }}"
            class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 rounded-xl transition">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a> -->

    </div>

    <!-- Banner -->

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        @if($kegiatan->gambar)

        <img
            src="{{ asset('storage/'.$kegiatan->gambar) }}"
            class="w-full h-[420px] object-cover">

        @else

        <div class="h-[420px] bg-slate-100 flex items-center justify-center">

            <i class="fa-solid fa-image text-7xl text-slate-300"></i>

        </div>

        @endif

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- Konten -->

        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

            <div class="flex items-center gap-3 mb-5">

                @if($kegiatan->status=="Aktif")

                <span class="px-4 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">

                    Aktif

                </span>

                @else

                <span class="px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                    Draft

                </span>

                @endif

                <span class="text-slate-400">

                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}

                </span>

            </div>

            <h2 class="text-4xl font-bold text-slate-800">

                {{ $kegiatan->judul }}

            </h2>

            <div class="mt-8 prose max-w-none text-slate-600 leading-8">

                {!! nl2br(e($kegiatan->deskripsi)) !!}

            </div>

        </div>

        <!-- Sidebar -->

        <div class="space-y-6">

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                <h3 class="text-lg font-bold mb-5">

                    Informasi Kegiatan

                </h3>

                <div class="space-y-5">

                    <div>

                        <p class="text-sm text-slate-500">

                            Tanggal

                        </p>

                        <p class="font-semibold">

                            {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Jam

                        </p>

                        <p class="font-semibold">

                            {{ $kegiatan->jam }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Lokasi

                        </p>

                        <p class="font-semibold">

                            {{ $kegiatan->lokasi }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Pemateri

                        </p>

                        <p class="font-semibold">

                            {{ $kegiatan->pemateri ?: '-' }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Status

                        </p>

                        <p class="font-semibold">

                            {{ $kegiatan->status }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">

                            Dibuat

                        </p>

                        <p class="font-semibold">

                            {{ $kegiatan->created_at->format('d F Y H:i') }}

                        </p>

                    </div>

                </div>

            </div>

            <!-- Action -->

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                <h3 class="text-lg font-bold mb-5">

                    Aksi

                </h3>

                <div class="space-y-3">

                    <a href="{{ route('kegiatan.edit',$kegiatan->id) }}"
                        class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-3">

                        <i class="fa-solid fa-pen"></i>

                        Edit Kegiatan

                    </a>

                    <a href="{{ route('kegiatan.index') }}"
                        class="w-full flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 rounded-xl py-3">

                        <i class="fa-solid fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection