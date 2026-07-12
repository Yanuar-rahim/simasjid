@extends('layouts.app')

@section('content')

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
                    class="absolute -bottom-8 left-8 bg-white rounded-3xl shadow-xl p-6 w-72">

                    <p class="text-slate-500">

                        Saldo Kas

                    </p>

                    <h3 class="text-3xl font-bold text-emerald-700 mt-2">

                        Rp51.500.000

                    </h3>

                    <p class="text-slate-500 mt-3">

                        Update Terakhir

                    </p>

                    <h4 class="font-semibold mt-1">

                        13 Juli 2026

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

        <div class="text-center">

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
                class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl p-8 text-white shadow-xl">

                <div class="flex justify-between">

                    <div>

                        <p class="text-emerald-100">

                            Total Pemasukan

                        </p>

                        <h2 class="text-3xl font-bold mt-3">

                            Rp125.000.000

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
                class="bg-white rounded-3xl shadow-lg p-8">

                <div class="flex justify-between">

                    <div>

                        <p class="text-slate-500">

                            Total Pengeluaran

                        </p>

                        <h2 class="text-3xl font-bold mt-3 text-red-500">

                            Rp73.500.000

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
                class="bg-white rounded-3xl shadow-lg p-8">

                <div class="flex justify-between">

                    <div>

                        <p class="text-slate-500">

                            Saldo Saat Ini

                        </p>

                        <h2 class="text-3xl font-bold mt-3 text-emerald-600">

                            Rp51.500.000

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
                class="bg-white rounded-3xl shadow-lg p-8">

                <div class="flex justify-between">

                    <div>

                        <p class="text-slate-500">

                            Jumlah Transaksi

                        </p>

                        <h2 class="text-3xl font-bold mt-3">

                            358

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
            class="bg-white rounded-3xl shadow-lg p-10">

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

            <div class="mt-10">

                <canvas id="chartKeuangan" height="100"></canvas>

            </div>

        </div>

    </div>

</section>

<!-- ======================================
            DATA PEMASUKAN
======================================= -->

<section class="py-24 bg-white">

    <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

        <div class="flex items-end justify-between">

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

        <div class="mt-12 overflow-hidden rounded-3xl shadow-lg border border-slate-200">

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

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            02 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Donasi Online

                        </td>

                        <td class="px-6 py-5">

                            Infak Jamaah

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-emerald-600">

                            Rp1.500.000

                        </td>

                    </tr>

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            05 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Kotak Amal

                        </td>

                        <td class="px-6 py-5">

                            Donasi Jumat

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-emerald-600">

                            Rp3.250.000

                        </td>

                    </tr>

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            08 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Wakaf

                        </td>

                        <td class="px-6 py-5">

                            Renovasi Masjid

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-emerald-600">

                            Rp10.000.000

                        </td>

                    </tr>

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            11 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Donasi Online

                        </td>

                        <td class="px-6 py-5">

                            Sedekah Jumat

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-emerald-600">

                            Rp2.850.000

                        </td>

                    </tr>

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

        <div class="flex items-end justify-between">

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

        <div class="mt-12 overflow-hidden rounded-3xl shadow-lg bg-white">

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

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            03 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Operasional

                        </td>

                        <td class="px-6 py-5">

                            Pembayaran Listrik

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-red-500">

                            Rp850.000

                        </td>

                    </tr>

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            06 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Sosial

                        </td>

                        <td class="px-6 py-5">

                            Santunan Anak Yatim

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-red-500">

                            Rp2.500.000

                        </td>

                    </tr>

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            09 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Perawatan

                        </td>

                        <td class="px-6 py-5">

                            Servis Sound System

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-red-500">

                            Rp1.250.000

                        </td>

                    </tr>

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            12 Juli 2026

                        </td>

                        <td class="px-6 py-5">

                            Kebersihan

                        </td>

                        <td class="px-6 py-5">

                            Pembelian Alat Kebersihan

                        </td>

                        <td class="px-6 py-5 text-right font-bold text-red-500">

                            Rp650.000

                        </td>

                    </tr>

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

        <div class="text-center">

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

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 mt-16">

            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl p-8 text-white shadow-xl">

                <h3 class="text-xl font-bold">

                    Januari

                </h3>

                <div class="mt-6 space-y-3">

                    <p>

                        Pemasukan

                        <span class="float-right font-bold">

                            Rp18.500.000

                        </span>

                    </p>

                    <p>

                        Pengeluaran

                        <span class="float-right font-bold">

                            Rp13.250.000

                        </span>

                    </p>

                    <hr class="border-white/20">

                    <p class="text-lg font-bold">

                        Saldo

                        <span class="float-right">

                            Rp5.250.000

                        </span>

                    </p>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-xl font-bold">

                    Februari

                </h3>

                <div class="mt-6 space-y-3">

                    <p>

                        Pemasukan

                        <span class="float-right font-bold text-emerald-600">

                            Rp21.700.000

                        </span>

                    </p>

                    <p>

                        Pengeluaran

                        <span class="float-right font-bold text-red-500">

                            Rp15.600.000

                        </span>

                    </p>

                    <hr>

                    <p class="text-lg font-bold">

                        Saldo

                        <span class="float-right text-emerald-600">

                            Rp6.100.000

                        </span>

                    </p>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-xl font-bold">

                    Maret

                </h3>

                <div class="mt-6 space-y-3">

                    <p>

                        Pemasukan

                        <span class="float-right font-bold text-emerald-600">

                            Rp20.200.000

                        </span>

                    </p>

                    <p>

                        Pengeluaran

                        <span class="float-right font-bold text-red-500">

                            Rp14.300.000

                        </span>

                    </p>

                    <hr>

                    <p class="text-lg font-bold">

                        Saldo

                        <span class="float-right text-emerald-600">

                            Rp5.900.000

                        </span>

                    </p>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h3 class="text-xl font-bold">

                    April

                </h3>

                <div class="mt-6 space-y-3">

                    <p>
                        Pemasukan
                        <span class="float-right font-bold text-emerald-600">
                            Rp24.800.000
                        </span>
                    </p>

                    <p>
                        Pengeluaran
                        <span class="float-right font-bold text-red-500">
                            Rp18.400.000
                        </span>
                    </p>

                    <hr>

                    <p class="text-lg font-bold">
                        Saldo

                        <span class="float-right text-emerald-600">
                            Rp6.400.000
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======================================
        INFORMASI TRANSPARANSI
======================================= -->

<!-- <section class="py-24 bg-slate-50">
    <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
        <div class="bg-white rounded-3xl shadow-xl">
            <div class="p-20 grid lg:grid-cols-2 gap-16">
                <div>

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

                <div class="space-y-6">
                    <div class="flex gap-5">
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

                    <div class="flex gap-5">
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

                    <div class="flex gap-5">
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

</section> -->

<!-- ======================================
            CTA
======================================= -->

<section class="py-24 bg-gradient-to-r from-emerald-700 via-emerald-600 to-green-600 text-white">
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
            class="inline-flex items-center gap-3 mt-10 px-10 py-5 rounded-2xl bg-white text-emerald-700 font-bold hover:scale-105 transition">
            <i class="fa-solid fa-hand-holding-heart"></i>
            Donasi Sekarang
        </a>
    </div>
</section>

@include('partials.footer')

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartKeuangan');

    new Chart(ctx, {
        type: 'bar',

        data: {

            labels: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun'
            ],

            datasets: [
                {
                    label: 'Pemasukan',
                    data: [
                        18,
                        22,
                        20,
                        25,
                        21,
                        19
                    ],
                    backgroundColor: '#10b981',
                    borderRadius: 10
                },
                
                {
                    label: 'Pengeluaran',
                    data: [
                        13,
                        15,
                        14,
                        18,
                        16,
                        15
                    ],
                    backgroundColor: '#ef4444',
                    borderRadius: 10
                }
            ]
        },

        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endpush