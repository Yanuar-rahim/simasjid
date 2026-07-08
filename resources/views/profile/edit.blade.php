<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Saya | SIMASJID</title>

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
                                    Rp0
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
                                    0
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
                                    {{ Auth::user()->created_at->format('d M Y') }}
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

                        <div class="max-w-3xl">

                            @include('profile.partials.update-profile-information-form')

                        </div>

                    </div>

                    <!-- Password -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">

                        <div class="max-w-3xl">

                            @include('profile.partials.update-password-form')

                        </div>

                    </div>

                    <!-- Hapus Akun -->
                    <div class="bg-white rounded-3xl shadow-lg p-8 border border-red-100">

                        <div class="max-w-3xl">

                            @include('profile.partials.delete-user-form')

                        </div>

                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">

                    <!-- Profil Singkat -->
                    <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                        @if(Auth::user()->foto)

                        <img
                            src="{{ asset('storage/'.Auth::user()->foto) }}"
                            class="w-28 h-28 rounded-full mx-auto object-cover border-4 border-emerald-500">

                        @else

                        <div
                            class="w-28 h-28 rounded-full bg-emerald-600 text-white flex items-center justify-center mx-auto text-4xl font-bold">

                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                        </div>

                        @endif

                        <h3 class="text-2xl font-bold mt-5">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-slate-500 mt-2">
                            {{ Auth::user()->email }}
                        </p>

                        <span class="inline-block mt-4 px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>

                    </div>

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
                                <span class="text-slate-500">Role</span>
                                <span class="font-semibold">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">Bergabung</span>
                                <span class="font-semibold">
                                    {{ Auth::user()->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">Total Donasi</span>
                                <span class="font-semibold text-emerald-600">
                                    Rp0
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">Jumlah Donasi</span>
                                <span class="font-semibold">
                                    0
                                </span>
                            </div>

                        </div>

                    </div>

                    <!-- Aktivitas Terbaru -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">

                        <h3 class="text-xl font-bold mb-6">
                            Aktivitas Terbaru
                        </h3>

                        <div class="space-y-5">

                            <div class="flex gap-4">

                                <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fa-solid fa-hand-holding-heart text-emerald-600"></i>
                                </div>

                                <div>

                                    <h4 class="font-semibold">
                                        Donasi Infak
                                    </h4>

                                    <p class="text-sm text-slate-500">
                                        10 Juli 2026 • Rp100.000
                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-4">

                                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                                    <i class="fa-solid fa-bullhorn text-blue-600"></i>
                                </div>

                                <div>

                                    <h4 class="font-semibold">
                                        Membaca Pengumuman
                                    </h4>

                                    <p class="text-sm text-slate-500">
                                        08 Juli 2026
                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-4">

                                <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-days text-yellow-600"></i>
                                </div>

                                <div>

                                    <h4 class="font-semibold">
                                        Melihat Jadwal Kegiatan
                                    </h4>

                                    <p class="text-sm text-slate-500">
                                        05 Juli 2026
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Achievement -->
                    <div class="bg-white rounded-3xl shadow-lg p-8">

                        <h3 class="text-xl font-bold mb-6">
                            Achievement Donatur
                        </h3>

                        <div class="space-y-4">

                            <div class="flex items-center justify-between rounded-2xl bg-yellow-50 border border-yellow-200 p-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-14 h-14 rounded-2xl bg-yellow-400 flex items-center justify-center text-white">
                                        <i class="fa-solid fa-medal text-xl"></i>
                                    </div>

                                    <div>

                                        <h4 class="font-semibold">
                                            Donatur Pemula
                                        </h4>

                                        <p class="text-sm text-slate-500">
                                            Telah melakukan donasi pertama.
                                        </p>

                                    </div>

                                </div>

                                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>

                            </div>

                            <div class="flex items-center justify-between rounded-2xl border p-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-14 h-14 rounded-2xl bg-slate-200 flex items-center justify-center">

                                        <i class="fa-solid fa-award text-slate-500 text-xl"></i>

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

                                <i class="fa-solid fa-lock text-slate-400"></i>

                            </div>

                            <div class="flex items-center justify-between rounded-2xl border p-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-14 h-14 rounded-2xl bg-slate-200 flex items-center justify-center">

                                        <i class="fa-solid fa-crown text-slate-500 text-xl"></i>

                                    </div>

                                    <div>

                                        <h4 class="font-semibold">
                                            Donatur Emas
                                        </h4>

                                        <p class="text-sm text-slate-500">
                                            Total donasi minimal Rp2.000.000.
                                        </p>

                                    </div>

                                </div>

                                <i class="fa-solid fa-lock text-slate-400"></i>

                            </div>

                            <div class="flex items-center justify-between rounded-2xl border p-4">

                                <div class="flex items-center gap-4">

                                    <div class="w-14 h-14 rounded-2xl bg-slate-200 flex items-center justify-center">

                                        <i class="fa-solid fa-gem text-slate-500 text-xl"></i>

                                    </div>

                                    <div>

                                        <h4 class="font-semibold">
                                            Sahabat Masjid
                                        </h4>

                                        <p class="text-sm text-slate-500">
                                            Berdonasi rutin selama 12 bulan.
                                        </p>

                                    </div>

                                </div>

                                <i class="fa-solid fa-lock text-slate-400"></i>

                            </div>

                        </div>

                    </div>

                    <!-- Progress Donasi -->
                    <div class="bg-gradient-to-br from-emerald-600 to-green-700 rounded-3xl p-8 text-white">

                        <h3 class="text-2xl font-bold">
                            Progress Donasi
                        </h3>

                        <p class="mt-2 text-emerald-100">
                            Menuju Donatur Aktif
                        </p>

                        <div class="mt-8">

                            <div class="flex justify-between text-sm mb-2">

                                <span>Rp100.000</span>

                                <span>Rp500.000</span>

                            </div>

                            <div class="w-full h-4 rounded-full bg-emerald-800">

                                <div
                                    class="h-4 rounded-full bg-white"
                                    style="width:20%;">

                                </div>

                            </div>

                        </div>

                        <p class="mt-5 text-sm leading-7 text-emerald-100">

                            Donasikan lagi sekitar
                            <b>Rp400.000</b>
                            untuk membuka badge
                            <b>Donatur Aktif.</b>

                        </p>

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