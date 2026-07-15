<header
    class="fixed left-72 right-0 top-0 h-24 bg-white border-b border-slate-200 z-30">

    <div class="h-full px-8 flex items-center justify-between">

        <!-- Judul -->
        <div>

            <h2 class="text-3xl font-bold text-slate-800">
                Dashboard
            </h2>

            <p class="text-slate-500 mt-1">
                Selamat datang kembali,
                {{ Auth::user()->name }}
            </p>

        </div>

        <!-- Kanan -->
        <div class="flex items-center gap-6">

            <!-- Tanggal & Jam -->
            <div class="">

                <div>

                    <i class="fa-regular fa-calendar"></i>

                    <span id="tanggalRealtime" class="font-bold"></span>

                </div>

                <div class="gap-2 mt-1">

                    <i class="fa-regular fa-clock text-emerald-600"></i>

                    <span
                        id="jamRealtime"
                        class="font-bold text-emerald-600 text-l">
                    </span>

                    <span class="text-l text-emerald-600 font-bold">
                        WITA
                    </span>

                </div>

            </div>

            <!-- Notification -->

            <!-- <button
                class="relative w-12 h-12 rounded-2xl border border-slate-200 hover:bg-slate-50 transition">

                <i class="fa-regular fa-bell"></i>

                <span
                    class="absolute top-3 right-3 w-2.5 h-2.5 rounded-full bg-red-500"></span>

            </button> -->

            <!-- Avatar -->

            <div x-data="{ open: false }" class="relative">

                <!-- Avatar -->
                <button
                    @click="open = !open"
                    class="w-12 h-12 rounded-full overflow-hidden shadow hover:scale-105 transition">

                    @if(Auth::user()->foto)

                    <img
                        src="{{ asset('storage/'.Auth::user()->foto) }}"
                        alt="Foto Profil"
                        class="w-full h-full object-cover">

                    @else

                    <div class="w-full h-full bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">

                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                    </div>

                    @endif

                </button>

                <!-- Dropdown -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-50">

                    <!-- Header -->
                    <div class="px-5 py-4 bg-slate-50">

                        <h4 class="font-semibold text-slate-800">
                            {{ Auth::user()->name }}
                        </h4>

                        <p class="text-sm text-slate-500">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                    <!-- Menu -->
                    <a href="#"
                        class="flex items-center gap-3 px-5 py-3 hover:bg-slate-100 transition">

                        <i class="fa-regular fa-user text-emerald-600"></i>

                        Profil

                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-5 py-3 hover:bg-slate-100 transition">

                        <i class="fa-solid fa-gear text-blue-600"></i>

                        Pengaturan

                    </a>

                    <form
                        id="logout-form"
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="button"
                            id="logout-button"
                            class="w-full flex items-center gap-3 px-5 py-3 text-red-600 hover:bg-red-50 transition">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>
        </div>

    </div>

</header>

<script>
    function updateClock() {

        const now = new Date();

        const tanggal = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        const jam = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        document.getElementById('tanggalRealtime').textContent = tanggal;
        document.getElementById('jamRealtime').textContent = jam;
    }

    updateClock();

    setInterval(updateClock, 1000);
</script>

@push('script');

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const logoutButton = document.getElementById('logout-button');

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