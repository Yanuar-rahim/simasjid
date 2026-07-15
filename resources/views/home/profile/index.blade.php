<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">
    @include('partials.navbar-user')
    <section class="pt-36 pb-20">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <!-- Judul -->
            <div class="mb-10">
                <span class="text-emerald-600 font-semibold">
                    Akun Saya
                </span>
                <h1 class="text-4xl font-bold mt-2">
                    Profil Pengguna
                </h1>
                <!-- Statistik -->
                <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6 mt-12">
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-slate-500">
                                    Total Donasi
                                </p>
                                <h2 class="text-3xl font-bold mt-2">
                                    Rp {{ number_format($totalDonasi,0,',','.') }}
                                </h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                                <i class="fa-solid fa-hand-holding-heart text-emerald-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-slate-500">
                                    Jumlah Donasi
                                </p>
                                <h2 class="text-3xl font-bold mt-2">
                                    {{ $jumlahDonasi }}
                                </h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                                <i class="fa-solid fa-wallet text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-slate-500">
                                    Bergabung
                                </p>
                                <h2 class="text-2xl font-bold mt-2">
                                    {{ Auth::user()->created_at->translatedFormat('d F Y') }}
                                </h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">
                                <i class="fa-solid fa-calendar text-yellow-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-slate-500">
                                    Status
                                </p>
                                <h2 class="text-2xl font-bold mt-2 text-emerald-600">
                                    Aktif
                                </h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                                <i class="fa-solid fa-circle-check text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-slate-500 mt-3">
                    Kelola informasi akun, ubah password, dan pengaturan akun Anda.
                </p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8 mt-10">
                <!-- Kolom Kiri -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Informasi Profil -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <div class="max-w-8xl">
                            @include('home.profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <div class="max-w-8xl">
                            @include('home.profile.partials.update-password-form')
                        </div>
                    </div>
                    <!-- Hapus Akun -->
                    <div class="bg-white rounded-3xl shadow-lg p-8 border border-red-100">
                        <div class="max-w-8xl">
                            @include('home.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Ringkasan Akun -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <h3 class="text-xl font-bold mb-6">
                            Ringkasan Akun
                        </h3>
                        <div class="space-y-5">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Status</span>
                                <span class="font-semibold text-green-600">
                                    Aktif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Bergabung</span>
                                <span class="font-semibold">
                                    {{ Auth::user()->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Total Donasi</span>
                                <span class="font-semibold text-emerald-600">
                                    Rp {{ number_format($totalDonasi,0,',','.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Jumlah Donasi</span>
                                <span class="font-semibold">
                                    {{ $jumlahDonasi }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Achievement -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <h3 class="text-xl font-bold mb-6">
                            Achievement Donatur
                        </h3>

                        <div class="space-y-4">

                            {{-- Donatur Pemula --}}
                            <div class="flex items-center justify-between rounded-2xl {{ $badgePemula ? 'bg-emerald-50 border border-emerald-200' : 'border' }} p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl {{ $badgePemula ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center">
                                        <i class="fa-solid fa-medal text-xl"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-semibold">Donatur Pemula</h4>
                                        <p class="text-sm text-slate-500">
                                            Telah melakukan donasi pertama.
                                        </p>
                                    </div>
                                </div>

                                @if($badgePemula)
                                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                                @else
                                <i class="fa-solid fa-lock text-slate-400"></i>
                                @endif
                            </div>
                            {{-- Donatur Aktif --}}
                            <div class="flex items-center justify-between rounded-2xl {{ $badgeAktif ? 'bg-blue-50 border border-blue-200' : 'border' }} p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl {{ $badgeAktif ? 'bg-blue-500 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center">
                                        <i class="fa-solid fa-award text-xl"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-semibold">
                                            Donatur Aktif
                                        </h4>

                                        <p class="text-sm text-slate-500">
                                            Total donasi minimal Rp500.000.
                                        </p>
                                    </div>
                                </div>

                                @if($badgeAktif)
                                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                                @else
                                <i class="fa-solid fa-lock text-slate-400"></i>
                                @endif
                            </div>

                            {{-- Donatur Emas --}}
                            <div class="flex items-center justify-between rounded-2xl {{ $badgeEmas ? 'bg-yellow-50 border border-yellow-300' : 'border' }} p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl {{ $badgeEmas ? 'bg-yellow-500 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center">
                                        <i class="fa-solid fa-crown text-xl"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-semibold">Donatur Emas</h4>
                                        <p class="text-sm text-slate-500">
                                            Total donasi minimal Rp2.000.000.
                                        </p>
                                    </div>
                                </div>

                                @if($badgeEmas)
                                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                                @else
                                <i class="fa-solid fa-lock text-slate-400"></i>
                                @endif
                            </div>
                            {{-- Sahabat Masjid --}}
                            <div class="flex items-center justify-between rounded-2xl {{ $badgeSahabat ? 'bg-purple-200 border border-purple-400' : 'border' }} p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl {{ $badgeSahabat ? 'bg-purple-600 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center">
                                        <i class="fa-solid fa-gem text-xl"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-semibold">
                                            Sahabat Masjid
                                        </h4>

                                        <p class="text-sm text-slate-500">
                                            Total donasi Rp5.000.000 + minimal 12 kali donasi.
                                        </p>
                                    </div>
                                </div>

                                @if($badgeSahabat)
                                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                                @else
                                <i class="fa-solid fa-lock text-slate-400"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Progress Donasi -->
                    <div class="bg-gradient-to-br from-emerald-600 to-green-700 rounded-3xl p-8 text-white">

                        <h3 class="text-2xl font-bold">
                            Progress Donasi
                        </h3>

                        <p class="mt-2 text-emerald-100">
                            {{ $level }}
                        </p>

                        @php

                        // if (!$badgeAktif) {

                        // $target = 500000;
                        // $namaBadge = 'Donatur Aktif';

                        // } elseif (!$badgeEmas) {

                        // $target = 2000000;
                        // $namaBadge = 'Donatur Emas';

                        // } elseif (!$badgeSahabat) {

                        // $target = 5000000;
                        // $namaBadge = 'Sahabat Masjid';

                        // } else {

                        // $target = 5000000;
                        // $namaBadge = 'Semua Badge';

                        // }

                        @endphp

                        <div class="mt-6">

                            <div class="flex justify-between text-sm mb-2">

                                <span>
                                    Rp {{ number_format($totalDonasi,0,',','.') }}
                                </span>

                                <span>
                                    Rp {{ number_format($target,0,',','.') }}
                                </span>

                            </div>

                            <div class="w-full h-4 rounded-full bg-emerald-800 overflow-hidden">

                                <div
                                    class="h-4 rounded-full bg-white transition-all duration-700"
                                    style="width: {{ $progress }}%;">
                                </div>

                            </div>

                            <div class="text-right mt-2 text-sm text-emerald-100">
                                {{ $progress }}%
                            </div>

                        </div>

                        @if($badgeSahabat)

                        <div class="mt-6 rounded-2xl bg-white/20 p-4">
                            <p class="font-bold">🎉 Selamat!</p>

                            <p class="text-sm mt-2 text-emerald-100">
                                Semua achievement berhasil dibuka.
                                Terima kasih telah menjadi <b>Sahabat Masjid.</b>
                            </p>
                        </div>

                        @elseif($badgeEmas)

                        <p class="mt-6 text-sm leading-7 text-emerald-100">
                            Donasikan lagi
                            <b>Rp {{ number_format($sisaDonasi,0,',','.') }}</b>
                            dan lakukan
                            <b>{{ $sisaDonasiCount }} donasi lagi</b>
                            untuk membuka
                            <b>Sahabat Masjid.</b>
                        </p>

                        @elseif($badgeAktif)

                        <p class="mt-6 text-sm leading-7 text-emerald-100">
                            Donasikan lagi
                            <b>Rp {{ number_format($sisaDonasi,0,',','.') }}</b>
                            untuk membuka
                            <b>Donatur Emas.</b>
                        </p>

                        @elseif($badgePemula)

                        <p class="mt-6 text-sm leading-7 text-emerald-100">
                            Donasikan lagi
                            <b>Rp {{ number_format($sisaDonasi,0,',','.') }}</b>
                            untuk membuka
                            <b>Donatur Aktif.</b>
                        </p>

                        @else

                        <p class="mt-6 text-sm leading-7 text-emerald-100">
                            Lakukan donasi pertama Anda untuk membuka
                            <b>Donatur Pemula.</b>
                        </p>

                        @endif

                    </div>
                    <!-- Motivasi -->
                    <div class="rounded-3xl bg-gradient-to-br from-emerald-600 to-green-700 p-8 text-white">
                        <i class="fa-solid fa-heart text-4xl"></i>
                        <h3 class="text-2xl font-bold mt-5">
                            Terus Beramal
                        </h3>
                        <p class="mt-4 leading-8 text-emerald-100">
                            Setiap donasi yang Anda berikan menjadi amal jariyah yang pahalanya terus mengalir. Terima kasih telah menjadi bagian dari SIMASJID.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.footer')
</body>

</html>