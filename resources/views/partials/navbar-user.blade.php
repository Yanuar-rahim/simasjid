<header
    class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-100"
    data-aos="fade-down">
    <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('user.home') }}" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-emerald-700 flex justify-center items-center text-white text-xl">
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
                    <a href="{{ route('user.home') }}"
                        class="{{ request()->routeIs('user.home') ? 'text-emerald-700 font-semibold' : 'hover:text-emerald-700 duration-300' }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.donasi') }}"
                        class="{{ request()->routeIs('user.donasi*') ? 'text-emerald-700 font-semibold' : 'hover:text-emerald-700 duration-300' }}">
                        Donasi
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.riwayat') }}"
                        class="{{ request()->routeIs('user.riwayat*') ? 'text-emerald-700 font-semibold' : 'hover:text-emerald-700 duration-300' }}">
                        Riwayat
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.kegiatan') }}"
                        class="{{ request()->routeIs('user.kegiatan*') ? 'text-emerald-700 font-semibold' : 'hover:text-emerald-700 duration-300' }}">
                        Kegiatan
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.pengumuman') }}"
                        class="{{ request()->routeIs('user.pengumuman*') ? 'text-emerald-700 font-semibold' : 'hover:text-emerald-700 duration-300' }}">
                        Pengumuman
                    </a>
                </li>
            </ul>
            <div
                x-data="{ open: false }"
                class="relative flex items-center gap-4">
                <button
                    @click="open = !open"
                    class="flex items-center gap-3 rounded-xl hover:bg-slate-100 px-3 py-2 transition">
                    <div class="hidden lg:block text-right">
                        <h4 class="font-semibold text-slate-800">
                            {{ Auth::user()->name }}
                        </h4>
                        <small class="text-slate-500">
                            Jamaah SIMASJID
                        </small>
                    </div>
                    @if(Auth::user()->foto)
                    <img
                        src="{{ asset('storage/'.Auth::user()->foto) }}"
                        class="w-11 h-11 rounded-full object-cover border-2 border-emerald-500">
                    @else
                    <div
                        class="w-11 h-11 rounded-full bg-emerald-700 text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>
                    @endif
                </button>
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 top-16 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden"
                    style="display:none;">
                    <!-- Header -->
                    <div class="bg-emerald-600 p-6 text-center text-white">
                        @if(Auth::user()->foto)
                        <img
                            src="{{ asset('storage/'.Auth::user()->foto) }}"
                            class="w-20 h-20 rounded-full mx-auto border-4 border-white object-cover">
                        @else
                        <div
                            class="w-20 h-20 rounded-full bg-white text-emerald-700 text-3xl font-bold flex items-center justify-center mx-auto">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                        @endif
                        <h3 class="font-bold text-lg mt-3">
                            {{ Auth::user()->name }}
                        </h3>
                        <p class="text-emerald-100 text-sm">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                    <div class="py-3">
                        <a
                            href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-6 py-3 hover:bg-slate-100 transition">
                            <i class="fa-regular fa-user w-5 text-emerald-600"></i>
                            Profil Saya
                        </a>
                        <a
                            href="{{ route('user.donasi') }}"
                            class="flex items-center gap-3 px-6 py-3 hover:bg-slate-100 transition">
                            <i class="fa-solid fa-hand-holding-heart w-5 text-emerald-600"></i>
                            Donasi Saya
                        </a>
                        <a
                            href="{{ route('user.riwayat') }}"
                            class="flex items-center gap-3 px-6 py-3 hover:bg-slate-100 transition">
                            <i class="fa-solid fa-clock-rotate-left w-5 text-emerald-600"></i>
                            Riwayat Donasi
                        </a>
                        <form
                            method="POST"
                            action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="w-full text-left flex items-center gap-3 px-6 py-3 hover:bg-red-50 text-red-600 transition">
                                <i class="fa-solid fa-right-from-bracket w-5"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>