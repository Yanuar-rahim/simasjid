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

            <button
                class="relative w-12 h-12 rounded-2xl border border-slate-200 hover:bg-slate-50 transition">

                <i class="fa-regular fa-bell"></i>

                <span
                    class="absolute top-3 right-3 w-2.5 h-2.5 rounded-full bg-red-500"></span>

            </button>

            <!-- Avatar -->

            <div
                class="w-12 h-12 rounded-full bg-emerald-600 text-white flex items-center justify-center font-semibold">

                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

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