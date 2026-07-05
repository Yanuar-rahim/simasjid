<nav
    class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-100"
    data-aos="fade-down">
    <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->

            <a href="/" class="flex items-center gap-3">
                <div
                    class="w-12 h-12 rounded-full bg-emerald-700 flex justify-center items-center text-white text-xl">
                    <i class="fa-solid fa-mosque"></i>
                </div>

                <div>
                    <h1 class="font-bold text-xl text-emerald-700">
                        SIMASJID
                    </h1>
                    <small class="text-slate-500">
                        Sistem Informasi Manajemen Masjid dan Keuangan Digital
                    </small>
                </div>
            </a>

            <!-- Menu -->

            <ul class="hidden lg:flex gap-8 font-medium">
                <li>
                    <a href="#home" class="hover:text-emerald-700 duration-300">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#tentang" class="hover:text-emerald-700 duration-300">
                        Tentang
                    </a>
                </li>
                <li>
                    <a href="#kegiatan" class="hover:text-emerald-700 duration-300">
                        Kegiatan
                    </a>
                </li>
                <li>
                    <a href="#keuangan" class="hover:text-emerald-700 duration-300">
                        Keuangan
                    </a>
                </li>
                <li>
                    <a href="#donasi" class="hover:text-emerald-700 duration-300">
                        Donasi
                    </a>
                </li>
            </ul>

            <div class="hidden lg:flex gap-3">
                <a href="{{ route('login') }}"
                    class="btn-primary">
                    Login
                </a>
            </div>

        </div>

    </div>

</nav>