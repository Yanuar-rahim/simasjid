<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">
    
    @include('partials.navbar-user')

    <!-- HERO -->
    <section id="beranda"
        class="pt-40 pb-24 bg-gradient-to-r from-emerald-700 via-emerald-600 to-green-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Kiri -->
                <div data-aos="fade-right">
                    <span
                        class="inline-flex items-center gap-2 bg-white/20 rounded-full px-5 py-2">
                        <i class="fa-solid fa-circle-check"></i>
                        Selamat Datang Kembali
                    </span>
                    <h1
                        class="mt-8 text-5xl lg:text-6xl font-bold leading-tight">
                        Assalamu'alaikum,
                        <br>
                        {{ Auth::user()->name }}
                    </h1>
                    <p
                        class="mt-8 text-xl leading-9 text-emerald-100">
                        Terima kasih telah menjadi bagian dari SIMASJID.
                        Kini Anda dapat melakukan donasi digital,
                        melihat riwayat donasi,
                        mengikuti kegiatan masjid,
                        dan memperoleh informasi terbaru secara mudah.
                    </p>
                    <div class="flex flex-wrap gap-5 mt-12">
                        <a
                            href="#donasi"
                            class="px-8 py-4 rounded-2xl bg-white text-emerald-700 font-semibold hover:scale-105 transition">
                            <i class="fa-solid fa-hand-holding-heart mr-2"></i>
                            Donasi Sekarang
                        </a>
                        <a
                            href="#riwayat"
                            class="px-8 py-4 rounded-2xl border border-white hover:bg-white hover:text-emerald-700 transition">
                            <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                            Riwayat Donasi
                        </a>
                    </div>
                </div>
                <!-- Kanan -->
<<<<<<< HEAD
<<<<<<< HEAD
                <div class="relative" data-aos="fade-left">
=======
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
>>>>>>> 197997ed7fbe93f2ccdd2d91cb6112be32996372
=======
                <div class="relative" data-aos="fade-left">
>>>>>>> d2f34ae75c04b95ecdd59a460e42e80480d00117
                    <img
                        src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full">
                    <div
                        class="absolute -bottom-8 left-8 bg-white rounded-3xl shadow-xl p-6 w-72">
                        <p class="text-slate-500">
                            Status Akun
                        </p>
                        <h3 class="text-3xl font-bold text-emerald-700 mt-2">
                            Aktif
                        </h3>
                        <p class="text-slate-500 mt-3">
                            Terakhir Login
                        </p>
                        <h4 class="font-semibold mt-1">
                            Hari Ini
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========================
        STATISTIK DONASI
    ============================ -->
    <section class="py-20 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center" data-aos="fade-up">
                <span class="text-emerald-600 font-semibold">
                    Dashboard Donatur
                </span>
                <h2 class="text-4xl font-bold mt-3">
                    Ringkasan Donasi Anda
                </h2>
                <p class="text-slate-500 mt-4">
                    Berikut ringkasan aktivitas donasi yang pernah Anda lakukan.
                </p>
            </div>
            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8 mt-14" data-aos="fade-up">
                <!-- Card -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl p-8 text-white shadow-xl" data-aos="fade-up">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-emerald-100">
                                Total Donasi
                            </p>
                            <h2 class="text-4xl font-bold mt-3">
                                Rp750.000
                            </h2>
                            <p class="mt-4 text-sm">
                                Sejak Bergabung
                            </p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-wallet text-3xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="bg-white rounded-3xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-slate-500">
                                Jumlah Donasi
                            </p>
                            <h2 class="text-4xl font-bold mt-3 text-slate-800">
                                12
                            </h2>
                            <p class="mt-4 text-sm text-emerald-600">
                                Donasi Berhasil
                            </p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center">
                            <i class="fa-solid fa-hand-holding-heart text-emerald-600 text-3xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="bg-white rounded-3xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-slate-500">
                                Donasi Terakhir
                            </p>
                            <h2 class="text-2xl font-bold mt-3 text-slate-800">
                                Rp100.000
                            </h2>
                            <p class="mt-4 text-sm text-slate-500">
                                08 Juli 2026
                            </p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                            <i class="fa-solid fa-clock-rotate-left text-blue-600 text-3xl"></i>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="bg-white rounded-3xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-slate-500">
                                Status Akun
                            </p>
                            <h2 class="text-2xl font-bold mt-3 text-emerald-600">
                                Aktif
                            </h2>
                            <p class="mt-4 text-sm text-slate-500">
                                Member SIMASJID
                            </p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center">
                            <i class="fa-solid fa-user-check text-yellow-500 text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========================
        QUICK MENU
    ============================ -->
    <section class="pb-20 bg-white" data-aos="fade-up">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid md:grid-cols-4 gap-8">
                <a href="#donasi"
                    class="group bg-emerald-600 rounded-3xl p-8 text-white hover:-translate-y-2 duration-300"
                    data-aos="zoom-in">
                    <i class="fa-solid fa-hand-holding-heart text-4xl"></i>
                    <h3 class="mt-6 text-2xl font-bold">
                        Donasi
                    </h3>
                    <p class="mt-3 text-emerald-100">
                        Salurkan donasi Anda secara online.
                    </p>
                </a>
                <a href="#riwayat"
                    class="group bg-white rounded-3xl shadow-lg p-8 hover:-translate-y-2 duration-300"
                    data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa-solid fa-receipt text-emerald-600 text-4xl"></i>
                    <h3 class="mt-6 text-2xl font-bold">
                        Riwayat
                    </h3>
                    <p class="mt-3 text-slate-500">
                        Lihat seluruh riwayat donasi Anda.
                    </p>
                </a>
                <a href="#kegiatan"
                    class="group bg-white rounded-3xl shadow-lg p-8 hover:-translate-y-2 duration-300"
                    data-aos="zoom-in" data-aos-delay="200">
                    <i class="fa-solid fa-calendar-days text-emerald-600 text-4xl"></i>
                    <h3 class="mt-6 text-2xl font-bold">
                        Kegiatan
                    </h3>
                    <p class="mt-3 text-slate-500">
                        Ikuti seluruh kegiatan masjid.
                    </p>
                </a>
                <a href="#pengumuman"
                    class="group bg-white rounded-3xl shadow-lg p-8 hover:-translate-y-2 duration-300"
                    data-aos="zoom-in" data-aos-delay="300">
                    <i class="fa-solid fa-bullhorn text-emerald-600 text-4xl"></i>
                    <h3 class="mt-6 text-2xl font-bold">
                        Pengumuman
                    </h3>
                    <p class="mt-3 text-slate-500">
                        Informasi terbaru dari pengurus.
                    </p>
                </a>
            </div>
        </div>
    </section>
    
    <!-- ===========================
        KEGIATAN TERBARU
    ============================ -->
    <section id="kegiatan" class="py-24 bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex justify-between items-end" data-aos="fade-up">
                <div>
                    <span class="text-emerald-600 font-semibold">
                        Program Masjid
                    </span>
                    <h2 class="text-4xl font-bold mt-2">
                        Kegiatan Terbaru
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Ikuti seluruh kegiatan yang diselenggarakan oleh masjid.
                    </p>
                </div>
                <a href="#" class="text-emerald-600 font-semibold">
                    Lihat Semua →
                </a>
            </div>
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8 mt-14">
                <!-- Card -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 duration-300" data-aos="fade-up">
                    <img src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full h-60 object-cover">
                    <div class="p-7">
                        <span class="inline-flex px-4 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                            Kajian
                        </span>
                        <h3 class="font-bold text-2xl mt-5">
                            Kajian Ba'da Maghrib
                        </h3>
                        <p class="text-slate-500 mt-4 leading-8">
                            Kajian rutin setiap malam Jumat bersama Ustadz Ahmad.
                        </p>
                        <div class="mt-6 space-y-2 text-slate-600">
                            <div>
                                <i class="fa-solid fa-calendar mr-2"></i>
                                12 Juli 2026
                            </div>
                            <div>
                                <i class="fa-solid fa-location-dot mr-2"></i>
                                Masjid Raya
                            </div>
                        </div>
                        <button
                            class="mt-8 w-full py-3 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-700">
                            Selengkapnya
                        </button>
                    </div>
                </div>
                <!-- Card -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full h-60 object-cover">
                    <div class="p-7">
                        <span class="inline-flex px-4 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                            Santunan
                        </span>
                        <h3 class="font-bold text-2xl mt-5">
                            Santunan Anak Yatim
                        </h3>
                        <p class="text-slate-500 mt-4 leading-8">
                            Penyaluran bantuan kepada anak yatim dan dhuafa.
                        </p>
                        <div class="mt-6 space-y-2 text-slate-600">
                            <div>
                                <i class="fa-solid fa-calendar mr-2"></i>
                                20 Juli 2026
                            </div>
                            <div>
                                <i class="fa-solid fa-location-dot mr-2"></i>
                                Aula Masjid
                            </div>
                        </div>
                        <button
                            class="mt-8 w-full py-3 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-700">
                            Selengkapnya
                        </button>
                    </div>
                </div>
                <!-- Card -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full h-60 object-cover">
                    <div class="p-7">
                        <span class="inline-flex px-4 py-1 rounded-full bg-orange-100 text-orange-700 text-sm">
                            Gotong Royong
                        </span>
                        <h3 class="font-bold text-2xl mt-5">
                            Kerja Bakti Masjid
                        </h3>
                        <p class="text-slate-500 mt-4 leading-8">
                            Membersihkan area masjid bersama seluruh jamaah.
                        </p>
                        <div class="mt-6 space-y-2 text-slate-600">
                            <div>
                                <i class="fa-solid fa-calendar mr-2"></i>
                                28 Juli 2026
                            </div>
                            <div>
                                <i class="fa-solid fa-location-dot mr-2"></i>
                                Halaman Masjid
                            </div>
                        </div>
                        <button
                            class="mt-8 w-full py-3 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-700">
                            Selengkapnya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================================
            PENGUMUMAN TERBARU
    ======================================= -->
    <section id="pengumuman" class="py-24 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex items-end justify-between" data-aos="fade-up">
                <div>
                    <span class="text-emerald-600 font-semibold">
                        Informasi Masjid
                    </span>
                    <h2 class="text-4xl font-bold mt-3">
                        Pengumuman Terbaru
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Ikuti informasi terbaru dari pengurus masjid.
                    </p>
                </div>
                <a href="#"
                    class="text-emerald-600 font-semibold hover:text-emerald-700">
                    Lihat Semua →
                </a>
            </div>
            <div class="grid lg:grid-cols-3 gap-8 mt-14">
                <!-- Card -->
                <div
                    class="bg-white rounded-3xl shadow-lg overflow-hidden hover:-translate-y-2 duration-300"
                    data-aos="fade-up">
                    <img
                        src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full h-56 object-cover">
                    <div class="p-7">
                        <span
                            class="inline-flex px-4 py-1 rounded-full bg-blue-100 text-blue-700">
                            Pengumuman
                        </span>
                        <h3 class="text-2xl font-bold mt-5">
                            Jadwal Sholat Idul Adha
                        </h3>
                        <p class="text-slate-500 leading-8 mt-4">
                            Pelaksanaan Sholat Idul Adha dimulai pukul 06.30 WITA.
                        </p>
                        <button
                            class="mt-8 text-emerald-600 font-semibold">
                            Selengkapnya →
                        </button>
                    </div>
                </div>
                <!-- Card -->
                <div
                    class="bg-white rounded-3xl shadow-lg overflow-hidden hover:-translate-y-2 duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <img
                        src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full h-56 object-cover">
                    <div class="p-7">
                        <span
                            class="inline-flex px-4 py-1 rounded-full bg-yellow-100 text-yellow-700">
                            Informasi
                        </span>
                        <h3 class="text-2xl font-bold mt-5">
                            Renovasi Tempat Wudhu
                        </h3>
                        <p class="text-slate-500 leading-8 mt-4">
                            Renovasi dilaksanakan mulai tanggal 20 Juli sampai selesai.
                        </p>
                        <button
                            class="mt-8 text-emerald-600 font-semibold">
                            Selengkapnya →
                        </button>
                    </div>
                </div>
                <!-- Card -->
                <div
                    class="bg-white rounded-3xl shadow-lg overflow-hidden hover:-translate-y-2 duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <img
                        src="{{ asset('assets/images/hero-masjid.png') }}"
                        class="w-full h-56 object-cover">
                    <div class="p-7">
                        <span
                            class="inline-flex px-4 py-1 rounded-full bg-emerald-100 text-emerald-700">
                            Agenda
                        </span>
                        <h3 class="text-2xl font-bold mt-5">
                            Musyawarah Pengurus
                        </h3>
                        <p class="text-slate-500 leading-8 mt-4">
                            Seluruh pengurus dimohon hadir pada rapat bulanan.
                        </p>
                        <button
                            class="mt-8 text-emerald-600 font-semibold">
                            Selengkapnya →
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================================
                CALL TO ACTION
    ======================================= -->
    <section class="py-24 bg-gradient-to-r from-emerald-700 to-emerald-600 text-white">
        <div class="max-w-5xl mx-auto text-center px-8" data-aos="zoom-in">
            <h2 class="text-5xl font-bold leading-tight">
                Mari Bersama Memakmurkan Masjid
            </h2>
            <p class="mt-8 text-xl leading-9 text-emerald-100">
                Setiap donasi yang Anda berikan akan menjadi amal jariyah
                yang terus mengalir pahalanya.
            </p>
            <a
                href="#donasi"
                class="inline-flex items-center gap-3 mt-10 px-10 py-5 rounded-2xl bg-white text-emerald-700 font-bold hover:scale-105 transition">
                <i class="fa-solid fa-hand-holding-heart"></i>
                Donasi Sekarang
            </a>
        </div>
    </section>
    
    @include('partials.footer')

</body>

</html>