<aside class="fixed left-0 top-0 h-screen w-72 bg-white border-r border-slate-200 z-40 flex flex-col">

    <!-- Logo -->
    <div class="h-24 flex items-center px-8 border-b border-slate-200">

        <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
            <i class="fa-solid fa-mosque text-emerald-600 text-2xl"></i>
        </div>

        <div class="ml-4">
            <h1 class="font-bold text-xl text-slate-800">
                SIMASJID
            </h1>

            <p class="text-sm text-slate-500">
                Admin Dashboard
            </p>
        </div>

    </div>

    <!-- Menu -->
    <nav class="flex-1 px-5 py-8 space-y-2">

        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-house"></i>
            Dashboard

        </a>

        <a href="#"
            class="{{ request()->routeIs('user-role') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-users"></i>
            Manajemen Role

        </a>

        <a href="{{ route('kegiatan.index') }}"
            class="{{ request()->routeIs('kegiatan.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-calendar-days"></i>
            Kegiatan

        </a>

        <a href="{{ route('pengumuman.index') }}"
            class="{{ request()->routeIs('pengumuman.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-bullhorn"></i>

            Pengumuman

        </a>

        <a href="{{ route('donasi.index') }}"
            class="{{ request()->routeIs('donasi.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-hand-holding-heart"></i>

            Donasi

        </a>

        <a href="{{ route('keuangan.index') }}"
            class="{{ request()->routeIs('keuangan.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-wallet"></i>
            Keuangan

        </a>

        <a href="{{ route('galeri.index') }}"
            class="{{ request()->routeIs('galeri.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-images"></i>
            Galeri

        </a>

        <a href="#"
            class="{{ request()->routeIs('masjid.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-mosque"></i>
            Profil Masjid

        </a>

        <a href="#"
            class="{{ request()->routeIs('laporan.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-chart-column"></i>
            Laporan

        </a>

        <a href="#"
            class="{{ request()->routeIs('setting.*') ? 'sidebar-active' : 'sidebar-menu' }}">

            <i class="fa-solid fa-gear"></i>
            Pengaturan

        </a>

    </nav>

    <!-- Footer -->
    <div class="border-t border-slate-200 p-5">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-full bg-emerald-600 flex items-center justify-center text-white font-semibold">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>

            <div>
                <h3 class="font-semibold">
                    {{ Auth::user()->name }}
                </h3>

                <p class="text-sm text-slate-500">
                    Administrator
                </p>
            </div>

        </div>

        <form
            id="sidebar-logout-form"
            method="POST"
            action="{{ route('logout') }}"
            class="mt-5">

            @csrf

            <button
                type="button"
                id="sidebar-logout-button"
                class="w-full rounded-2xl bg-red-50 hover:bg-red-100 text-red-600 py-3 transition duration-300">

                <i class="fa-solid fa-right-from-bracket mr-2"></i>

                Logout

            </button>

        </form>

    </div>

</aside>

@push('script');

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutButton = document.getElementById('sidebar-logout-button');

        if (logoutButton) {
            logoutButton.addEventListener('click', function() {

                Swal.fire({
                    title: 'Logout?',
                    text: 'Apakah Anda yakin ingin keluar dari sistem?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#059669',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: '<i class="fa-solid fa-check"></i> Ya, Logout',
                    cancelButtonText: '<i class="fa-solid fa-xmark"></i> Batal',
                    reverseButtons: true

                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Sedang Logout...',
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,

                            didOpen: () => {

                                Swal.showLoading();
                                setTimeout(() => {
                                    document.getElementById('logout-form').submit();
                                }, 700);
                            }
                        });
                    }
                });
            });
        }
    });
</script>