@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Statistik -->

    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mt-5">

        <!-- Card -->

        <div class="dashboard-card">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Total User

                    </p>

                    <h2 class="mt-3 text-4xl font-bold">

                        245

                    </h2>

                    <p class="mt-3 text-sm text-emerald-600">

                        +12 bulan ini

                    </p>

                </div>

                <div class="dashboard-icon">

                    <i class="fa-solid fa-users"></i>

                </div>

            </div>

        </div>

        <div class="dashboard-card">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Total Donasi

                    </p>

                    <h2 class="mt-3 text-4xl font-bold">

                        Rp48 Jt

                    </h2>

                    <p class="mt-3 text-sm text-emerald-600">

                        +18%

                    </p>

                </div>

                <div class="dashboard-icon">

                    <i class="fa-solid fa-hand-holding-heart"></i>

                </div>

            </div>

        </div>

        <div class="dashboard-card">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Kegiatan

                    </p>

                    <h2 class="mt-3 text-4xl font-bold">

                        18

                    </h2>

                    <p class="mt-3 text-sm text-emerald-600">

                        3 Minggu ini

                    </p>

                </div>

                <div class="dashboard-icon">

                    <i class="fa-solid fa-calendar-days"></i>

                </div>

            </div>

        </div>

        <div class="dashboard-card">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Saldo Kas

                    </p>

                    <h2 class="mt-3 text-4xl font-bold">

                        Rp124 Jt

                    </h2>

                    <p class="mt-3 text-sm text-emerald-600">

                        Update Hari Ini

                    </p>

                </div>

                <div class="dashboard-icon">

                    <i class="fa-solid fa-wallet"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- Grafik + Jadwal -->

    <div class="grid xl:grid-cols-3 gap-6">

        <!-- Grafik -->

        <div class="xl:col-span-2 dashboard-card">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-xl font-semibold">

                        Grafik Donasi

                    </h3>

                    <p class="text-slate-500 text-sm mt-1">

                        Perkembangan donasi setiap bulan

                    </p>

                </div>

                <select
                    class="border border-slate-200 rounded-xl px-4 py-2 text-sm">

                    <option>2026</option>

                    <option>2025</option>

                </select>

            </div>

            <div class="mt-8 h-96">

                <canvas id="donasiChart" height="120"></canvas>

            </div>

        </div>

        <!-- Jadwal -->

        <div class="dashboard-card">

            <h3 class="text-xl font-semibold">

                Jadwal Hari Ini

            </h3>

            <div class="mt-8 space-y-5">

                <div class="border-l-4 border-emerald-500 pl-4">

                    <p class="font-semibold">

                        Kajian Ba'da Maghrib

                    </p>

                    <span class="text-sm text-slate-500">

                        18.30 WIB

                    </span>

                </div>

                <div class="border-l-4 border-blue-500 pl-4">

                    <p class="font-semibold">

                        Rapat DKM

                    </p>

                    <span class="text-sm text-slate-500">

                        13.00 WIB

                    </span>

                </div>

                <div class="border-l-4 border-orange-500 pl-4">

                    <p class="font-semibold">

                        Santunan Anak Yatim

                    </p>

                    <span class="text-sm text-slate-500">

                        09.00 WIB

                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- Aktivitas -->

    <div class="dashboard-card">

        <div class="flex justify-between">

            <h3 class="text-xl font-semibold">

                Aktivitas Terbaru

            </h3>

            <button class="text-emerald-600">

                Lihat Semua

            </button>

        </div>

        <div class="mt-8 space-y-6">

            <div class="flex justify-between">

                <div>

                    <h4 class="font-semibold">

                        Donasi berhasil diterima

                    </h4>

                    <p class="text-slate-500">

                        Ahmad menyumbang Rp500.000

                    </p>

                </div>

                <span class="text-sm text-slate-400">

                    5 menit lalu

                </span>

            </div>

            <div class="flex justify-between">

                <div>

                    <h4 class="font-semibold">

                        User baru mendaftar

                    </h4>

                    <p class="text-slate-500">

                        Muhammad Rizki

                    </p>

                </div>

                <span class="text-sm text-slate-400">

                    15 menit lalu

                </span>

            </div>

        </div>

    </div>

</div>

@endsection