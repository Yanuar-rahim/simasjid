<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMASJID | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">

    @include('partials.navbar')

    <section
        id="home"
        class="min-h-screen flex items-center">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-2 gap-14 items-center">

                <!-- Left -->

                <div data-aos="fade-right">
                    <span
                        class="bg-emerald-100 text-emerald-700 px-5 py-2 rounded-full">
                        Selamat Datang di SIMASJID
                    </span>

                    <h1
                        class="mt-6 text-3xl sm:text-4xl lg:text-6xl font-bold leading-tight">
                        Kelola
                        <span class="text-emerald-700">
                            Masjid
                        </span>
                        Lebih Modern
                        dan Transparan
                    </h1>

                    <p
                        class="mt-6 text-slate-600 text-base lg:text-lg leading-7 lg:leading-8">
                        Sistem Informasi Manajemen Masjid dan Keuangan Digital
                        membantu pengurus dalam mengelola kegiatan,
                        keuangan,
                        donasi,
                        serta pelayanan jamaah secara terintegrasi
                        dan transparan.
                    </p>

                    <div class="flex gap-4 mt-10">
                        <a href="{{ route('donasi.index') }}"
                            class="btn-primary">
                            Donasi Sekarang
                        </a>

                        <a href="#tentang"
                            class="btn-secondary">
                            Pelajari
                        </a>
                    </div>

                    <div
                        class="grid grid-cols-3 gap-5 mt-16">
                        <div class="card text-center">
                            <h2 class="text-3xl font-bold text-emerald-700">
                                {{ number_format($jumlahJamaah) }}
                            </h2>
                            <p>
                                Jamaah
                            </p>
                        </div>

                        <div class="card text-center">
                            <h2 class="text-3xl font-bold text-emerald-700">
                                {{ $jumlahKegiatan }}
                            </h2>
                            <p>
                                Program
                            </p>
                        </div>

                        <div class="card text-center">
                            <h2 class="text-3xl font-bold text-emerald-700">
                                Rp {{ number_format($totalDonasi,0,',','.') }}
                            </h2>
                            <p>
                                Donasi
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right -->

                <div
                    class="relative"
                    data-aos="fade-left">
                    <div
                        class="absolute inset-0 bg-emerald-300 rounded-full blur-3xl opacity-20">
                    </div>
                    <img
                        src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="relative z-10 w-full rounded-3xl pt-15">
                </div>
            </div>
        </div>
    </section>

    <!-- ===========================
Tentang
============================ -->

    <section id="tentang" class="section bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Gambar -->

                <div data-aos="fade-right">
                    <div class="relative">
                        <img
                            src="{{ asset('assets/images/about.jpg') }}"
                            alt="Masjid"
                            class="rounded-3xl shadow-2xl">

                        <div
                            class="absolute -bottom-8 -right-8 bg-emerald-700 text-white rounded-2xl p-6 shadow-xl">
                            <h2 class="text-4xl font-bold">
                                20+
                            </h2>
                            <p>
                                Tahun Melayani Umat
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Konten -->

                <div data-aos="fade-left">
                    <span
                        class="text-emerald-700 font-semibold">
                        Tentang Kami
                    </span>
                    <h2 class="title mt-3">
                        Masjid Sebagai Pusat Ibadah,
                        Dakwah,
                        dan Pelayanan Umat
                    </h2>
                    <p class="subtitle">
                        Sistem Informasi Manajemen Masjid dikembangkan
                        untuk membantu pengurus dalam mengelola kegiatan,
                        keuangan,
                        aset,
                        serta pelayanan jamaah secara digital,
                        transparan,
                        dan terintegrasi.
                    </p>
                    <div class="grid md:grid-cols-2 gap-5 mt-10">
                        <div class="card">
                            <div
                                class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                                <i class="fa-solid fa-eye text-emerald-700 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-xl mt-5">
                                Visi
                            </h3>
                            <p class="mt-3 text-slate-500">
                                {{ $masjid->visi ?? '-'}}
                            </p>
                        </div>
                        <div class="card">
                            <div
                                class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center">
                                <i class="fa-solid fa-bullseye text-amber-500 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-xl mt-5">
                                Misi
                            </h3>
                            <ul class="list-disc pl-5 space-y-2 ">
                                @foreach(explode("\n", $masjid->misi ?? '-') as $misi)
                                    @if(trim($misi) != '')
                                        <li class="mt-3 text-slate-500">{{ $misi }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center mb-16">
                <h2 class="title">
                    Statistik Masjid
                </h2>
                <p class="subtitle">
                    Data singkat mengenai aktivitas dan pelayanan masjid.
                </p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="card text-center" data-aos="zoom-in">
                    <i class="fa-solid fa-users text-5xl text-emerald-700"></i>
                    <h2 class="text-5xl font-bold mt-6">
                        {{ number_format($jumlahJamaah) }}
                    </h2>
                    <p class="mt-3">
                        Jamaah Terdaftar
                    </p>
                </div>
                <div class="card text-center" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa-solid fa-calendar-days text-5xl text-emerald-700"></i>
                    <h2 class="text-5xl font-bold mt-6">
                        {{ number_format($jumlahKegiatan) }}
                    </h2>
                    <p class="mt-3">
                        Program Tahunan
                    </p>
                </div>
                <div class="card text-center" data-aos="zoom-in" data-aos-delay="200">
                    <i class="fa-solid fa-hand-holding-dollar text-5xl text-emerald-700"></i>
                    <h2 class="text-5xl font-bold mt-6">
                        Rp {{ number_format($totalDonasi,0,',','.') }}
                    </h2>
                    <p class="mt-3">
                        Donasi Tahun Ini
                    </p>
                </div>
                <div class="card text-center" data-aos="zoom-in" data-aos-delay="300">
                    <i class="fa-solid fa-user-tie text-5xl text-emerald-700"></i>
                    <h2 class="text-5xl font-bold mt-6">
                        {{ $jumlahPengurus }}
                    </h2>
                    <p class="mt-3">
                        Pengurus Aktif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===========================
        JADWAL SHOLAT
=========================== -->

    <section class="py-24 bg-gradient-to-r from-emerald-700 via-emerald-600 to-green-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center">
                <span class="inline-flex items-center gap-2 bg-white/20 px-5 py-2 rounded-full">
                    <i class="fa-solid fa-mosque"></i>
                    Jadwal Sholat
                </span>
                <h2 class="text-5xl font-bold mt-6">
                    Jadwal Sholat Hari Ini
                </h2>
                <p class="mt-5 text-xl text-emerald-100">
                    {{ now()->translatedFormat('l, d F Y') }}
                    • Kota Baubau (WITA)
                </p>
            </div>
            @if($jadwalSholat)
            @php
            $jadwal = [
            [
            'nama'=>'Subuh',
            'jam'=>substr($jadwalSholat['Fajr'],0,5),
            'icon'=>'fa-cloud-moon',
            'warna'=>'text-indigo-500',
            'bg'=>'bg-indigo-100'
            ],
            [
            'nama'=>'Dzuhur',
            'jam'=>substr($jadwalSholat['Dhuhr'],0,5),
            'icon'=>'fa-sun',
            'warna'=>'text-yellow-500',
            'bg'=>'bg-yellow-100'
            ],
            [
            'nama'=>'Ashar',
            'jam'=>substr($jadwalSholat['Asr'],0,5),
            'icon'=>'fa-cloud-sun',
            'warna'=>'text-orange-500',
            'bg'=>'bg-orange-100'
            ],
            [
            'nama'=>'Maghrib',
            'jam'=>substr($jadwalSholat['Maghrib'],0,5),
            'icon'=>'fa-mountain-sun',
            'warna'=>'text-red-500',
            'bg'=>'bg-red-100'
            ],
            [
            'nama'=>'Isya',
            'jam'=>substr($jadwalSholat['Isha'],0,5),
            'icon'=>'fa-star-and-crescent',
            'warna'=>'text-blue-500',
            'bg'=>'bg-blue-100'
            ],
            ];
            @endphp
            @php

            $nextPrayer = null;
            $now = \Carbon\Carbon::now('Asia/Makassar');

            foreach($jadwal as $item){

            $waktu = \Carbon\Carbon::today('Asia/Makassar')
            ->setTimeFromTimeString($item['jam']);

            if($now->lt($waktu)){
            $nextPrayer = [
            'nama'=>$item['nama'],
            'jam'=>$item['jam']
            ];
            break;
            }
            }

            if(!$nextPrayer){

            $nextPrayer=[
            'nama'=>'Subuh',
            'jam'=>$jadwal[0]['jam']
            ];
            }
            @endphp
            <div
                class="bg-white rounded-[35px] shadow-2xl p-10 mt-16 text-center">
                <span
                    class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 px-5 py-2 rounded-full font-semibold">
                    <i class="fa-solid fa-mosque"></i>
                    Sholat Berikutnya
                </span>
                <h2
                    class="text-5xl font-bold text-slate-800 mt-6">
                    {{ $nextPrayer['nama'] }}
                </h2>
                <p
                    class="text-7xl font-extrabold text-emerald-700 mt-4">
                    {{ $nextPrayer['jam'] }}
                </p>
                <div class="mt-8">
                    <p class="text-slate-500">
                        Sisa Waktu
                    </p>
                    <h3
                        id="countdown"
                        class="text-4xl font-bold text-red-500 mt-3">
                        00:00:00
                    </h3>
                </div>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-8 mt-16 items-stretch">
                @foreach($jadwal as $item)
                <div class="bg-white rounded-3xl p-8 shadow-xl text-center transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:ring-4 hover:ring-white/30">
                    <div class="w-24 h-24 mx-auto rounded-full {{ $item['bg'] }} flex items-center justify-center">
                        <i class="fa-solid {{ $item['icon'] }} text-5xl {{ $item['warna'] }}"></i>
                    </div>
                    <h3 class="mt-7 text-2xl font-bold text-slate-800">
                        {{ $item['nama'] }}
                    </h3>
                    <p class="mt-5 text-5xl font-extrabold text-emerald-700 tracking-wide">
                        {{ $item['jam'] }}
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 text-sm font-semibold">
                            WITA
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- ===========================
Program Kegiatan
============================ -->

    <section id="kegiatan" class="section bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center mb-16">
                <span class="text-emerald-700 font-semibold">
                    Program Masjid
                </span>
                <h2 class="title mt-2">
                    Kegiatan Terbaru
                </h2>
                <p class="subtitle">
                    Berbagai kegiatan ibadah, pendidikan, dan sosial yang diselenggarakan oleh masjid.
                </p>
                <a href="{{ url('/kegiatan') }}" class="inline-flex items-center gap-2 mt-6 text-emerald-700 font-semibold hover:gap-3 transition-all">
                    Lihat Semua Kegiatan
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($kegiatan->count())
                @foreach($kegiatan as $item)
                <div
                    class="group overflow-hidden rounded-3xl bg-white shadow-lg hover:-translate-y-2 transition duration-500">
                    <img
                        src="{{ $item->gambar
                                ? asset('storage/'.$item->gambar)
                                : asset('assets/images/no-image.png') }}"
                        class="w-full h-60 object-cover">
                    <div class="p-7">
                        <span class="inline-flex items-center gap-2 text-sm text-emerald-700">
                            <i class="fa-solid fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </span>
                        <h3 class="font-bold text-2xl mt-4">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-slate-500 mt-4 leading-8">
                            {{ Str::limit($item->deskripsi,51) }}
                        </p>
                        <a
                            href="{{ route('public.kegiatan.detail', $item->slug) }}"
                            class="inline-flex items-center gap-2 mt-6 text-emerald-700 font-semibold hover:gap-3 transition-all">
                            Selengkapnya
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-span-3">
                    <div class="text-center py-20">
                        <i class="fa-solid fa-calendar-xmark text-6xl text-slate-300"></i>
                        <h3 class="mt-5 text-2xl font-semibold">
                            Belum ada kegiatan
                        </h3>
                        <p class="text-slate-500 mt-2">
                            Data kegiatan akan tampil di sini.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ===========================
Pengumuman
============================ -->

    <section class="section bg-slate-100" id="pengumuman">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center mb-16">
                <span class="text-emerald-700 font-semibold">
                    Informasi
                </span>
                <h2 class="title mt-2">
                    Pengumuman Terbaru
                </h2>
                <p class="subtitle">
                    Informasi terbaru mengenai kegiatan dan layanan masjid.
                </p>
                <a href="{{ url('/pengumuman') }}" class="inline-flex items-center gap-2 mt-6 text-emerald-700 font-semibold hover:gap-3 transition-all">
                    Lihat Semua Pengumuman
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($pengumuman as $item)
                <div
                    class="bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 transition duration-300">
                    @if($item->gambar)
                    <img
                        src="{{ asset('storage/'.$item->gambar) }}"
                        class="w-full h-56 object-cover">
                    @else
                    <img
                        src="{{ asset('assets/images/no-image.png') }}"
                        class="w-full h-56 object-cover">
                    @endif
                    <div class="p-7">
                        <div class="flex items-center justify-between">
                            <span
                                class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                                {{ $item->kategori }}
                            </span>
                            <span class="text-sm text-slate-500">
                                {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-2xl mt-5">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-slate-500 leading-8 mt-4">
                            {{ Str::limit(strip_tags($item->isi),100) }}
                        </p>
                        <a
                            href="{{ route('public.pengumuman.detail',$item->slug) }}"
                            class="inline-flex items-center gap-2 mt-6 text-emerald-700 font-semibold hover:gap-3 transition">
                            Selengkapnya
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3">
                    <div class="text-center py-20">
                        <i class="fa-solid fa-bullhorn text-6xl text-slate-300"></i>
                        <h3 class="text-2xl font-semibold mt-5">
                            Belum ada pengumuman
                        </h3>
                        <p class="text-slate-500 mt-2">
                            Pengumuman terbaru akan tampil di sini.
                        </p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ===========================
Donasi
============================ -->

    <section
        id="donasi"
        class="section bg-gradient-to-r from-emerald-700 to-emerald-800 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <span
                        class="bg-white/20 px-5 py-2 rounded-full">
                        Donasi Digital
                    </span>
                    <h2
                        class="text-5xl font-bold mt-6 leading-tight">
                        Mari Berbagi
                        Kebaikan
                        Bersama Masjid
                    </h2>
                    <p
                        class="mt-6 text-emerald-100 leading-8">
                        Donasi dapat dilakukan melalui QRIS,
                        Transfer Bank,
                        maupun E-Wallet.
                        Seluruh transaksi akan tercatat secara otomatis
                        dan ditampilkan pada halaman transparansi keuangan.
                    </p>
                    <div class="flex flex-wrap gap-4 mt-10">
                        <div class="bg-white text-slate-700 px-5 py-3 rounded-xl">
                            <i class="fa-solid fa-building-columns"></i>
                            Transfer
                        </div>
                        <div class="bg-white text-slate-700 px-5 py-3 rounded-xl">
                            QRIS
                        </div>
                        <div class="bg-white text-slate-700 px-5 py-3 rounded-xl">
                            Dana
                        </div>
                        <div class="bg-white text-slate-700 px-5 py-3 rounded-xl">
                            OVO
                        </div>
                        <div class="bg-white text-slate-700 px-5 py-3 rounded-xl">
                            GoPay
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center"
                    data-aos="zoom-in">
                    <img
                        src="{{ asset('assets/images/qris.png') }}"
                        class="w-80 rounded-3xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- ===========================
Transparansi Keuangan
============================ -->

    <section id="keuangan" class="section bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center mb-16">
                <span class="text-emerald-700 font-semibold">
                    Transparansi
                </span>
                <h2 class="title mt-2">
                    Laporan Keuangan
                </h2>
                <p class="subtitle">
                    Seluruh pemasukan dan pengeluaran masjid disajikan secara transparan.
                </p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="card text-center">
                    <i class="fa-solid fa-wallet text-5xl text-emerald-600"></i>
                    <h3 class="mt-5 text-2xl font-bold">
                        Rp {{ number_format($totalPemasukan,0,',','.') }}
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Total Pemasukan
                    </p>
                </div>
                <div class="card text-center">
                    <i class="fa-solid fa-money-bill-wave text-5xl text-red-500"></i>
                    <h3 class="mt-5 text-2xl font-bold">
                        Rp {{ number_format($totalPengeluaran,0,',','.') }}
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Total Pengeluaran
                    </p>
                </div>
                <div class="card text-center">
                    <i class="fa-solid fa-piggy-bank text-5xl text-amber-500"></i>
                    <h3 class="mt-5 text-2xl font-bold">
                        Rp {{ number_format($saldoKas,0,',','.') }}
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Saldo Akhir
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===========================
Galeri
============================ -->

    <section class="py-24 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center mb-16">
                <span class="text-emerald-700 font-semibold">
                    Galeri
                </span>
                <h2 class="text-4xl font-bold mt-3">
                    Dokumentasi Kegiatan Masjid
                </h2>
                <p class="text-slate-500 mt-4">
                    Dokumentasi berbagai kegiatan yang telah dilaksanakan
                    oleh pengurus Masjid.
                </p>
            </div>
            @if($galeri->count())
            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">
                    @foreach($galeri as $item)
                    <div class="swiper-slide">
                        <a
                            href="{{ asset('storage/'.$item->gambar) }}"
                            class="glightbox">
                            <div
                                class="relative overflow-hidden rounded-3xl shadow-xl group cursor-pointer">
                                <!-- IMAGE -->
                                <img
                                    src="{{ asset('storage/'.$item->gambar) }}"
                                    class="w-full h-96 object-cover transition-all duration-700 group-hover:scale-110">
                                <!-- OVERLAY -->
                                <div
                                    class="absolute inset-0
                                            bg-gradient-to-t
                                            from-black/90
                                            via-black/40
                                            to-transparent
                                            opacity-0
                                            group-hover:opacity-100
                                            transition-all
                                            duration-500">
                                </div>

                                <!-- GARIS HIJAU -->
                                <div
                                    class="absolute left-0 top-0 h-full w-1 bg-emerald-500
                                            scale-y-0
                                            group-hover:scale-y-100
                                            origin-bottom
                                            transition-all
                                            duration-500">
                                </div>

                                <!-- CONTENT -->
                                <div
                                    class="absolute inset-0 z-20 flex flex-col justify-end p-7">

                                    <!-- JUDUL -->
                                    <h3
                                        class="text-2xl font-bold text-white
                                                translate-y-14
                                                opacity-0
                                                group-hover:translate-y-0
                                                group-hover:opacity-100
                                                transition-all
                                                duration-500">
                                        {{ $item->judul }}
                                    </h3>

                                    <!-- DESKRIPSI -->
                                    <p
                                        class="mt-3 text-slate-200 leading-7
                                                translate-y-14
                                                opacity-0
                                                group-hover:translate-y-0
                                                group-hover:opacity-100
                                                transition-all
                                                duration-700
                                                delay-100">
                                        {{ Str::limit($item->deskripsi,80) }}
                                    </p>

                                    <!-- FOOTER -->
                                    <div
                                        class="mt-6 flex items-center justify-between
                                                translate-y-14
                                                opacity-0
                                                group-hover:translate-y-0
                                                group-hover:opacity-100
                                                transition-all
                                                duration-700
                                                delay-200">
                                        <span
                                            class="text-sm text-white flex items-center gap-2">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                        </span>

                                        <!-- Tombol Glass -->
                                        <span
                                            class="w-12 h-12 rounded-full
                                                    bg-white/20
                                                    backdrop-blur-md
                                                    border border-white/30
                                                    flex items-center justify-center
                                                    text-white
                                                    hover:bg-emerald-600
                                                    transition">
                                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-10"></div>
            </div>
            @else
            <div class="text-center py-20">
                <i class="fa-solid fa-images text-6xl text-slate-300"></i>
                <h3 class="text-2xl font-semibold mt-5">
                    Belum ada galeri
                </h3>
                <p class="text-slate-500 mt-2">
                    Dokumentasi kegiatan akan tampil di sini.
                </p>
            </div>
            @endif
        </div>
    </section>

    <!-- ===========================
Lokasi
============================ -->

    <section class="section bg-slate-100">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-2 gap-16">
                <div>
                    <span class="text-emerald-700 font-semibold">
                        Lokasi
                    </span>
                    <h2 class="title mt-2">
                        {{ $masjid->nama_masjid ?? '-' }}
                    </h2>
                    <p class="subtitle">
                        {{ $masjid->alamat ?? '-' }}
                    </p>
                    <div class="space-y-5 mt-10">
                        <div>
                            <i class="fa-solid fa-phone text-emerald-700"></i>
                            {{ $masjid->telepon ?? '-' }}
                        </div>
                        <div>
                            <i class="fa-solid fa-envelope text-emerald-700"></i>
                            {{ $masjid->email ?? '-' }}
                        </div>
                        <div>
                            <i class="fa-solid fa-location-dot text-emerald-700"></i>
                            Baubau, Sulawesi Tenggara
                        </div>
                    </div>
                </div>
                <div>
                    @if($masjid && $masjid->google_maps)
                        <iframe
                            class="rounded-3xl shadow-xl w-full h-96"
                            src="{{ $masjid->google_maps }}"
                            loading="lazy">
                        </iframe>
                    @else
                        <div class="w-full h-96 rounded-3xl bg-slate-100 border border-dashed border-slate-300 flex flex-col items-center justify-center">
                            <i class="fa-solid fa-map-location-dot text-5xl text-slate-400 mb-4"></i>
                            <h3 class="font-semibold text-slate-700">
                                Google Maps belum tersedia
                            </h3>
                            <p class="text-slate-500 mt-2">
                                Silakan lengkapi Profil Masjid terlebih dahulu.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('partials.footer')

    <script>
        const targetTime = "{{ $nextPrayer['jam'] }}";

        function updateCountdown() {

            const now = new Date();

            let target = new Date();

            const jam = targetTime.split(":");

            target.setHours(jam[0]);
            target.setMinutes(jam[1]);
            target.setSeconds(0);

            if (now > target) {
                target.setDate(target.getDate() + 1);
            }

            const diff = target - now;

            const h = Math.floor(diff / 1000 / 60 / 60);
            const m = Math.floor(diff / 1000 / 60) % 60;
            const s = Math.floor(diff / 1000) % 60;

            document.getElementById("countdown").innerHTML =
                String(h).padStart(2, '0') + " : " +
                String(m).padStart(2, '0') + " : " +
                String(s).padStart(2, '0');

        }

        updateCountdown();

        setInterval(updateCountdown, 1000);
    </script>

</body>

</html>