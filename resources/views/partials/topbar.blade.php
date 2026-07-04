<header
    class="fixed left-72 right-0 top-0 h-24 bg-white border-b border-slate-200 z-30">

    <div class="h-full px-8 flex items-center justify-between">

        <div>

            <h2 class="text-3xl font-bold text-slate-800">

                Dashboard

            </h2>

            <p class="text-slate-500 mt-1">

                Selamat datang kembali,
                {{ Auth::user()->name }}

            </p>

        </div>

        <div class="flex items-center gap-6">

            <!-- Search -->

            <div class="relative">

                <i
                    class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input
                    type="text"
                    placeholder="Cari menu..."
                    class="pl-12 pr-5 h-12 w-72 rounded-2xl border border-slate-200 focus:outline-none focus:border-emerald-500">

            </div>

            <!-- Notification -->

            <button
                class="relative w-12 h-12 rounded-2xl border border-slate-200 hover:bg-slate-50">

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