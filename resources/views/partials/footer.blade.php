<!-- ======================================
                    FOOTER
    ======================================= -->
    <footer class="bg-slate-900 text-slate-300">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28 py-20">
            <div class="grid lg:grid-cols-4 gap-12">
                <!-- Logo -->
                <div>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-mosque text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">
                                SIMASJID
                            </h2>
                        </div>
                    </div>
                    <p class="mt-6 leading-8">
                        Sistem Informasi Manajemen Masjid yang membantu
                        pengurus dan jamaah dalam pengelolaa kegiatan,
                        donasi, dan informasi secara digital.
                    </p>
                </div>
                <!-- Menu -->
                <div>
                    <h3 class="text-xl font-semibold text-white">
                        Menu
                    </h3>
                    <ul class="space-y-4 mt-6">
                        <li><a href="#beranda" class="hover:text-white">Beranda</a></li>
                        <li><a href="#donasi" class="hover:text-white">Donasi</a></li>
                        <li><a href="#riwayat" class="hover:text-white">Riwayat</a></li>
                        <li><a href="#kegiatan" class="hover:text-white">Kegiatan</a></li>
                    </ul>
                </div>
                <!-- Kontak -->
                <div>
                    <h3 class="text-xl font-semibold text-white">
                        Kontak
                    </h3>
                    <ul class="space-y-4 mt-6">
                        <li>
                            <i class="fa-solid fa-location-dot mr-2"></i>
                            Kota Baubau
                        </li>
                        <li>
                            <i class="fa-solid fa-phone mr-2"></i>
                            0812-3456-7890
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope mr-2"></i>
                            admin@simasjid.id
                        </li>
                    </ul>
                </div>
                <!-- Sosial -->
                <div>
                    <h3 class="text-xl font-semibold text-white">
                        Media Sosial
                    </h3>
                    <div class="flex gap-4 mt-6">
                        <a href="#"
                            class="w-12 h-12 rounded-full bg-slate-800 hover:bg-emerald-600 flex items-center justify-center">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 rounded-full bg-slate-800 hover:bg-emerald-600 flex items-center justify-center">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 rounded-full bg-slate-800 hover:bg-emerald-600 flex items-center justify-center">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-16 pt-8 text-center">
                © {{ date('Y') }} SIMASJID.
                All Rights Reserved.
            </div>
        </div>
    </footer>