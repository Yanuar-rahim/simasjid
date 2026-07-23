<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparansi Keuangan | Sistem Informasi Manajemen Masjid</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">
    @include('partials.navbar-user')
    <!-- ======================================
            HERO
======================================= -->
    <section
        class="pt-40 pb-24 bg-gradient-to-r from-emerald-700 via-emerald-600 to-green-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Kiri -->
                <div data-aos="fade-right">
                    <span
                        class="inline-flex items-center gap-2 bg-white/20 rounded-full px-5 py-2">
                        <i class="fa-solid fa-scale-balanced"></i>
                        Transparansi Keuangan
                    </span>
                    <h1 class="mt-8 text-5xl lg:text-6xl font-bold leading-tight">
                        Laporan Keuangan
                        <br>
                        Masjid
                    </h1>
                    <p class="mt-8 text-xl leading-9 text-emerald-100">
                        Seluruh pemasukan dan pengeluaran masjid
                        ditampilkan secara terbuka sebagai bentuk
                        transparansi kepada seluruh jamaah.
                    </p>
                </div>
                <!-- Kanan -->
                <div
                    class="relative"
                    data-aos="fade-left">
                    <img
                        src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full">
                    <div
                        class="absolute -bottom-8 left-8 bg-white rounded-3xl shadow-xl p-6 w-72"
                        data-aos="zoom-in"
                        data-aos-delay="300">
                        <p class="text-slate-500">
                            Total Pemasukan
                        </p>
                        <h3 class="text-3xl font-bold text-emerald-700 mt-2">
                            Rp {{ number_format($totalPemasukan,0,',','.') }}
                        </h3>
                        <p class="text-slate-500 mt-3">
                            Update Terakhir
                        </p>
                        <h4 class="font-semibold mt-1 text-slate-800">
                            {{ now()->translatedFormat('d F Y') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================================
        RINGKASAN KEUANGAN
======================================= -->
    <section class="py-20 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center" data-aos="fade-up">
                <span class="text-emerald-600 font-semibold">
                    Ringkasan
                </span>
                <h2 class="text-4xl font-bold mt-3">
                    Statistik Keuangan Masjid
                </h2>
                <p class="text-slate-500 mt-4">
                    Data berikut merupakan akumulasi pemasukan
                    dan pengeluaran masjid.
                </p>
            </div>
            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8 mt-14">
                <!-- Total Pemasukan -->
                <div
                    class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl p-8 text-white shadow-xl"
                    data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-emerald-100">
                                Total Pemasukan
                            </p>
                            <h2 class="text-3xl font-bold mt-3">
                                Rp {{ number_format($totalPemasukan,0,',','.') }}
                            </h2>
                        </div>
                        <div
                            class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-arrow-down text-3xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Pengeluaran -->
                <div
                    class="bg-white rounded-3xl shadow-lg p-8"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-slate-500">
                                Total Pengeluaran
                            </p>
                            <h2 class="text-3xl font-bold mt-3 text-red-500">
                                Rp {{ number_format($totalPengeluaran,0,',','.') }}
                            </h2>
                        </div>
                        <div
                            class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                            <i class="fa-solid fa-arrow-up text-red-500 text-3xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Saldo -->
                <div
                    class="bg-white rounded-3xl shadow-lg p-8"
                    data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-slate-500">
                                Saldo Saat Ini
                            </p>
                            <h2 class="text-3xl font-bold mt-3 text-emerald-600">
                                Rp {{ number_format($saldoKas,0,',','.') }}
                            </h2>
                        </div>
                        <div
                            class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center">
                            <i class="fa-solid fa-wallet text-emerald-600 text-3xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Jumlah Transaksi -->
                <div
                    class="bg-white rounded-3xl shadow-lg p-8"
                    data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-slate-500">
                                Jumlah Transaksi
                            </p>
                            <h2 class="text-3xl font-bold mt-3">
                                {{ $pemasukan->count() + $pengeluaran->count() }}
                            </h2>
                        </div>
                        <div
                            class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                            <i class="fa-solid fa-receipt text-blue-600 text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================================
            GRAFIK
======================================= -->
    <section class="pb-24 bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div
                class="bg-white rounded-3xl shadow-lg p-10"
                data-aos="zoom-in">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold">
                            Grafik Keuangan
                        </h2>
                        <p class="text-slate-500 mt-2">
                            Perbandingan pemasukan dan pengeluaran
                            setiap bulan.
                        </p>
                    </div>
                </div>
                <div class="mt-10 h-[450px]">
                    <canvas id="chartKeuangan"></canvas>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================================
            DATA PEMASUKAN
======================================= -->
    <section class="py-24 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex items-end justify-between" data-aos="fade-up">
                <div>
                    <span class="text-emerald-600 font-semibold">
                        Laporan
                    </span>
                    <h2 class="text-4xl font-bold mt-3">
                        Riwayat Pemasukan
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Seluruh pemasukan yang diterima oleh masjid.
                    </p>
                </div>
            </div>
            <div
                class="mt-12 overflow-hidden rounded-3xl shadow-lg border border-slate-200"
                data-aos="fade-up"
                data-aos-delay="150">
                <table class="w-full">
                    <thead class="bg-emerald-600 text-white">
                        <tr>
                            <th class="px-6 py-5 text-left">
                                Tanggal
                            </th>
                            <th class="px-6 py-5 text-left">
                                Sumber
                            </th>
                            <th class="px-6 py-5 text-left">
                                Keterangan
                            </th>
                            <th class="px-6 py-5 text-right">
                                Nominal
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemasukan as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-5">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-5">
                                {{ $item->sumber }}
                            </td>
                            <td class="px-6 py-5">
                                {{ $item->keterangan }}
                            </td>
                            <td class="px-6 py-5 text-right font-bold text-emerald-600">
                                Rp {{ number_format($item->nominal,0,',','.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-wallet text-6xl text-emerald-200 mb-5"></i>
                                    <h3 class="text-xl font-semibold text-slate-700">
                                        Belum Ada Data Pemasukan
                                    </h3>
                                    <p class="text-slate-500 mt-2">
                                        Data pemasukan masjid akan muncul di sini.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- ======================================
            DATA PENGELUARAN
======================================= -->
    <section class="pb-24 bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex items-end justify-between" data-aos="fade-up">
                <div>
                    <span class="text-red-500 font-semibold">
                        Penggunaan Dana
                    </span>
                    <h2 class="text-4xl font-bold mt-3">
                        Riwayat Pengeluaran
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Dana yang telah digunakan untuk operasional dan kegiatan masjid.
                    </p>
                </div>
            </div>
            <div
                class="mt-12 overflow-hidden rounded-3xl shadow-lg bg-white"
                data-aos="fade-up"
                data-aos-delay="150">
                <table class="w-full">
                    <thead class="bg-red-500 text-white">
                        <tr>
                            <th class="px-6 py-5 text-left">
                                Tanggal
                            </th>
                            <th class="px-6 py-5 text-left">
                                Kategori
                            </th>
                            <th class="px-6 py-5 text-left">
                                Keterangan
                            </th>
                            <th class="px-6 py-5 text-right">
                                Nominal
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengeluaran as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-5">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-5">
                                {{ $item->kategori }}
                            </td>
                            <td class="px-6 py-5">
                                {{ $item->keterangan }}
                            </td>
                            <td class="px-6 py-5 text-right font-bold text-red-600">
                                Rp {{ number_format($item->nominal,0,',','.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-file-invoice-dollar text-6xl text-red-200 mb-5"></i
                                    <h3 class="text-xl font-semibold text-slate-700">
                                        Belum Ada Data Pengeluaran
                                    </h3>
                                    <p class="text-slate-500 mt-2">
                                        Data pengeluaran masjid akan muncul di sini.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- ======================================
            REKAP BULANAN
======================================= -->
    <section class="py-24 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center" data-aos="fade-up">
                <span class="text-emerald-600 font-semibold">
                    Rekapitulasi
                </span>
                <h2 class="text-4xl font-bold mt-3">
                    Rekap Keuangan Bulanan
                </h2>
                <p class="text-slate-500 mt-4">
                    Ringkasan pemasukan dan pengeluaran setiap bulan.
                </p>
            </div>
            @if($pemasukan->count() == 0 && $pengeluaran->count() == 0)
            <div class="bg-white rounded-3xl shadow-lg py-20 text-center mt-16">
                <i class="fa-solid fa-chart-column text-6xl text-slate-300"></i>
                <h3 class="mt-6 text-2xl font-bold text-slate-700">
                    Belum Ada Rekap Keuangan
                </h3>
                <p class="text-slate-500 mt-3">
                    Rekap bulanan akan ditampilkan setelah terdapat transaksi pemasukan atau pengeluaran.
                </p>
            </div>
            @else
            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 mt-16">
                @foreach($rekapBulanan as $item)
                <div
                    class="bg-white rounded-3xl shadow-lg p-8"
                    data-aos="zoom-in"
                    data-aos-delay="{{ $index * 100 }}">
                    <h3 class="text-xl font-bold">
                        {{ $item['bulan'] }}
                    </h3>
                    <div class="mt-6 space-y-3">
                        <p>
                            Pemasukan
                            <span class="float-right font-bold text-emerald-600">
                                Rp {{ number_format($item['pemasukan'],0,',','.') }}
                            </span>
                        </p>
                        <p>
                            Pengeluaran
                            <span class="float-right font-bold text-red-500">
                                Rp {{ number_format($item['pengeluaran'],0,',','.') }}
                            </span>
                        </p>
                        <hr>
                        <p class="text-lg font-bold">
                            Saldo
                            <span class="float-right text-emerald-600">
                                Rp {{ number_format($item['saldo'],0,',','.') }}
                            </span>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <!-- ======================================
        INFORMASI TRANSPARANSI
======================================= -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div
                class="bg-white rounded-3xl shadow-xl"
                data-aos="fade-up">
                <div class="flex flex-col lg:flex-row gap-16 p-10 lg:p-20">
                    <div data-aos="fade-right">
                        <span class="text-emerald-600 font-semibold">
                            Transparansi
                        </span>
                        <h2 class="text-4xl font-bold mt-4">
                            Komitmen Pengelolaan Dana Masjid
                        </h2>
                        <p class="text-slate-500 leading-9 mt-8">
                            Seluruh dana yang diterima oleh masjid
                            digunakan untuk kegiatan ibadah,
                            operasional, pembangunan,
                            pendidikan, dan kegiatan sosial.
                        </p>
                    </div>
                    <div
                        class="space-y-6"
                        data-aos="fade-left"
                        data-aos-delay="200">
                        <div
                            class="flex gap-5"
                            data-aos="fade-left"
                            data-aos-delay="100">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            </div>
                            <div>
                                <h3 class="font-bold">
                                    Transparan
                                </h3>
                                <p class="text-slate-500 mt-2">
                                    Seluruh pemasukan dan pengeluaran dapat dilihat jamaah.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-5"
                            data-aos="fade-left"
                            data-aos-delay="200">
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                                <i class="fa-solid fa-file-invoice text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-bold">
                                    Tercatat
                                </h3>
                                <p class="text-slate-500 mt-2">
                                    Setiap transaksi disimpan ke dalam sistem.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-5"
                            data-aos="fade-left"
                            data-aos-delay="300">
                            <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                                <i class="fa-solid fa-shield-halved text-yellow-500"></i>
                            </div>
                            <div>
                                <h3 class="font-bold">
                                    Akuntabel
                                </h3>
                                <p class="text-slate-500 mt-2">
                                    Dana digunakan sesuai kebutuhan dan program masjid.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================================
            CTA
======================================= -->
    <section
        class="py-24 bg-gradient-to-r from-emerald-700 via-emerald-600 to-green-600 text-white"
        data-aos="zoom-in">
        <div class="max-w-5xl mx-auto text-center px-8">
            <h2 class="text-5xl font-bold">
                Mari Bersama Memakmurkan Masjid
            </h2>
            <p class="mt-8 text-xl leading-9 text-emerald-100">
                Setiap donasi yang Anda berikan akan tercatat
                secara transparan dan digunakan
                untuk kemaslahatan umat.
            </p>
            <a href="{{ route('user.donasi') }}"
                class="inline-flex items-center gap-3 mt-10 px-10 py-5 rounded-2xl bg-white text-emerald-700 font-bold hover:scale-105 transition"
                data-aos="fade-up"
                data-aos-delay="300">
                <i class="fa-solid fa-hand-holding-heart"></i>
                Donasi Sekarang
            </a>
        </div>
    </section>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        const ctx = document.getElementById('chartKeuangan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labelsBulan),
                datasets: [{
                        label: 'Pemasukan',
                        data: @json($chartPemasukan),
                        backgroundColor: '#10b981',
                        borderRadius: 8
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($chartPengeluaran),
                        backgroundColor: '#ef4444',
                        borderRadius: 8
                    }
                ]
            }
        });
    </script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 80,
        });
    </script>
</body>
</html>