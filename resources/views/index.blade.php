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
                        🕌 Selamat Datang di SIMASJID
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
                        <a href="#donasi"
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
                            <h2
                                class="text-3xl font-bold text-emerald-700">
                                1200+
                            </h2>

                            <p>
                                Jamaah
                            </p>
                        </div>

                        <div class="card text-center">
                            <h2
                                class="text-3xl font-bold text-emerald-700">
                                45
                            </h2>
                            <p>
                                Program
                            </p>
                        </div>

                        <div class="card text-center">
                            <h2
                                class="text-3xl font-bold text-emerald-700">
                                150JT
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

                                Menjadi masjid yang modern,
                                mandiri,
                                profesional,
                                dan transparan.

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

                            <p class="mt-3 text-slate-500">

                                Memberikan pelayanan terbaik kepada jamaah
                                melalui pemanfaatan teknologi informasi.

                            </p>

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

                        1.250

                    </h2>

                    <p class="mt-3">

                        Jamaah Terdaftar

                    </p>

                </div>

                <div class="card text-center" data-aos="zoom-in" data-aos-delay="100">

                    <i class="fa-solid fa-calendar-days text-5xl text-emerald-700"></i>

                    <h2 class="text-5xl font-bold mt-6">

                        56

                    </h2>

                    <p class="mt-3">

                        Program Tahunan

                    </p>

                </div>

                <div class="card text-center" data-aos="zoom-in" data-aos-delay="200">

                    <i class="fa-solid fa-hand-holding-dollar text-5xl text-emerald-700"></i>

                    <h2 class="text-5xl font-bold mt-6">

                        Rp350JT

                    </h2>

                    <p class="mt-3">

                        Donasi Tahun Ini

                    </p>

                </div>

                <div class="card text-center" data-aos="zoom-in" data-aos-delay="300">

                    <i class="fa-solid fa-user-tie text-5xl text-emerald-700"></i>

                    <h2 class="text-5xl font-bold mt-6">

                        18

                    </h2>

                    <p class="mt-3">

                        Pengurus Aktif

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- ===========================
Jadwal Sholat
============================ -->

    <section class="section bg-emerald-700 text-white">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <div class="text-center">

                <h2 class="text-4xl font-bold">

                    Jadwal Sholat Hari Ini

                </h2>

                <p class="mt-4 text-emerald-100">

                    Jadwal dapat diintegrasikan dengan API Aladhan atau Kementerian Agama.

                </p>

            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6 mt-16">

                @php
                $jadwal = [
                ['Subuh','04:31'],
                ['Dzuhur','12:03'],
                ['Ashar','15:23'],
                ['Maghrib','18:01'],
                ['Isya','19:12'],
                ];
                @endphp

                @foreach($jadwal as $item)

                <div
                    class="bg-white text-slate-800 rounded-3xl p-8 text-center shadow-xl hover:scale-105 duration-300">

                    <i class="fa-solid fa-mosque text-emerald-700 text-4xl"></i>

                    <h3 class="font-semibold text-xl mt-5">

                        {{ $item[0] }}

                    </h3>

                    <p class="text-4xl font-bold text-emerald-700 mt-4">

                        {{ $item[1] }}

                    </p>

                </div>

                @endforeach

            </div>

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

                        Rp 125.000.000

                    </h3>

                    <p class="text-slate-500 mt-2">

                        Total Pemasukan

                    </p>

                </div>

                <div class="card text-center">

                    <i class="fa-solid fa-money-bill-wave text-5xl text-red-500"></i>

                    <h3 class="mt-5 text-2xl font-bold">

                        Rp 47.500.000

                    </h3>

                    <p class="text-slate-500 mt-2">

                        Total Pengeluaran

                    </p>

                </div>

                <div class="card text-center">

                    <i class="fa-solid fa-piggy-bank text-5xl text-amber-500"></i>

                    <h3 class="mt-5 text-2xl font-bold">

                        Rp 77.500.000

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

    <section class="section bg-white">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <div class="text-center mb-16">

                <span class="text-emerald-700 font-semibold">

                    Galeri

                </span>

                <h2 class="title mt-2">

                    Dokumentasi Kegiatan

                </h2>

            </div>

            <div class="swiper gallerySwiper">

                <div class="swiper-wrapper">

                    @for($i=1;$i<=6;$i++)

                        <div class="swiper-slide">

                        <img
                            src="{{ asset('assets/images/gallery-'.$i.'.jpg') }}"
                            class="rounded-3xl w-full h-80 object-cover">

                </div>

                @endfor

            </div>

            <div class="swiper-pagination mt-5"></div>

        </div>

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

                        Masjid Agung Kota Baubau

                    </h2>

                    <p class="subtitle">

                        Jl. Ra. Kartini, Wale, Kec. Wolio, Kota Bau-Bau, Sulawesi Tenggara 93717

                    </p>

                    <div class="space-y-5 mt-10">

                        <div>

                            <i class="fa-solid fa-phone text-emerald-700"></i>

                            +62-823-3109-6562

                        </div>

                        <div>

                            <i class="fa-solid fa-envelope text-emerald-700"></i>

                            info@simasjid.id

                        </div>

                        <div>

                            <i class="fa-solid fa-location-dot text-emerald-700"></i>

                            Baubau, Sulawesi Tenggara

                        </div>

                    </div>

                </div>

                <div>

                    <iframe

                        class="rounded-3xl shadow-xl w-full h-96"

                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.7382716257252!2d122.60487546266906!3d-5.456636288596722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2da47695257c6f23%3A0xa617a155c6221be6!2sMasjid%20Agung%20Kota%20Baubau!5e0!3m2!1sid!2sid!4v1783104183228!5m2!1sid!2sid"

                        loading="lazy">

                    </iframe>

                </div>

            </div>

        </div>

    </section>

    @include('partials.footer')