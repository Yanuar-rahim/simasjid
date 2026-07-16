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
                        {{ $totalUser }}
                    </h2>
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
                        Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                    </h2>
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
                        {{$jumlahKegiatan}}
                    </h2>
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
                        Rp {{ number_format($saldoKas, 0, ',', '.') }}
                    </h2>
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

        <!-- Kegiatan Terbaru -->

        <div class="dashboard-card">

            <h3 class="text-xl font-semibold">
                Kegiatan Terbaru
            </h3>

            <div class="mt-8 space-y-5">

                @forelse($kegiatanTerbaru as $kegiatan)

                @php
                $warna = match($loop->index % 4){
                0 => 'border-emerald-500',
                1 => 'border-blue-500',
                2 => 'border-orange-500',
                default => 'border-purple-500',
                };
                @endphp

                <div class="border-l-4 {{ $warna }} pl-4">

                    <p class="font-semibold">
                        {{ $kegiatan->judul }}
                    </p>

                    <span class="text-sm text-slate-500">
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}
                    </span>

                </div>

                @empty

                <div class="text-center py-8">

                    <i class="fa-solid fa-calendar-xmark text-4xl text-slate-300"></i>

                    <p class="mt-3 text-slate-500">
                        Belum ada kegiatan.
                    </p>

                </div>

                @endforelse

            </div>

        </div>
    </div>

    <!-- Aktivitas -->

    <div class="dashboard-card">
        @forelse($aktivitas as $item)

        <div class="flex justify-between items-start py-4">

            <div class="flex gap-4">

                <div class="w-11 h-11 rounded-xl bg-{{ $item->color }}-100 flex items-center justify-center">

                    <i class="fa-solid {{ $item->icon }} text-{{ $item->color }}-600"></i>

                </div>

                <div>

                    <h4 class="font-semibold">
                        {{ $item->aktivitas }}
                    </h4>

                    <p class="text-slate-500">
                        {{ $item->deskripsi }}
                    </p>

                </div>

            </div>

            <span class="text-sm text-slate-400">
                {{ $item->created_at->diffForHumans() }}
            </span>

        </div>

        @empty

        <p class="text-slate-500 text-center py-6">
            Belum ada aktivitas.
        </p>

        @endforelse
    </div>
</div>

@endsection

@push('scripts')

<script>
    window.dashboardData = {
        labels: @json($labels),
        chartDonasi: @json($chartDonasi)
    };
</script>

@if(session('login_success'))

<script>
    document.addEventListener('DOMContentLoaded', function() {

        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: 'Selamat datang kembali, {{ Auth::user()->name }}',
            timer: 2200,
            showConfirmButton: false,
            timerProgressBar: true
        });

    });
</script>

@endif

@endpush