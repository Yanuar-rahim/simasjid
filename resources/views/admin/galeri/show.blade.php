@extends('layouts.admin')

@section('content')

<div class="max-w-8xl mx-auto space-y-8">

    <!-- Header -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Detail Galeri

            </h1>

            <p class="text-slate-500 mt-2">

                Informasi lengkap dokumentasi kegiatan masjid.

            </p>

        </div>

        <div class="flex gap-3">

            <a
                href="{{ route('galeri.edit',$galeri) }}"
                class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white">

                <i class="fa-solid fa-pen mr-2"></i>

                Edit

            </a>

            <a
                href="{{ route('galeri.index') }}"
                class="px-6 py-3 rounded-2xl border border-slate-300 hover:bg-slate-100">

                Kembali

            </a>

        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- Foto -->

        <img
            src="{{ asset('storage/'.$galeri->gambar) }}"
            class="w-full h-[500px] object-cover">

        <div class="p-10">

            <div class="flex justify-between items-start flex-wrap gap-6">

                <div>

                    <h2 class="text-4xl font-bold text-slate-800">

                        {{ $galeri->judul }}

                    </h2>

                    <div class="mt-5 flex flex-wrap gap-6 text-slate-500">

                        <span>

                            <i class="fa-solid fa-calendar mr-2 text-emerald-600"></i>

                            {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}

                        </span>

                        <span>

                            <i class="fa-solid fa-user mr-2 text-blue-600"></i>

                            {{ $galeri->user->name ?? '-' }}

                        </span>

                    </div>

                </div>

                @if($galeri->status)

                <span class="px-5 py-2 rounded-full bg-emerald-100 text-emerald-700 font-semibold">

                    Aktif

                </span>

                @else

                <span class="px-5 py-2 rounded-full bg-red-100 text-red-600 font-semibold">

                    Tidak Aktif

                </span>

                @endif

            </div>

            <h3 class="text-xl font-bold text-slate-700 mt-6">

                Deskripsi

            </h3>

            <p class="mt-4 leading-9 text-slate-600 whitespace-pre-line">

                {{ $galeri->deskripsi ?: 'Tidak ada deskripsi.' }}

            </p>

        </div>

    </div>

</div>

@endsection