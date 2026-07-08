<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">

    @include('partials.navbar-user')

    <section
        id="donasi"
        class="py-24 bg-slate-50">
        <div class="max-w-5xl mx-auto px-8">
            <div class="text-center">
                <span class="text-emerald-600 font-semibold">
                    Donasi Online
                </span>
                <h2 class="text-4xl font-bold mt-3">
                    Form Donasi Digital
                </h2>
                <p class="text-slate-500 mt-4">
                    Silakan isi formulir berikut untuk melakukan donasi.
                </p>
            </div>
            <form
                action="#"
                method="POST"
                class="bg-white rounded-[35px] shadow-xl p-10 mt-14">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <label class="font-semibold">
                            Nama Donatur
                        </label>
                        <input
                            type="text"
                            value="{{ Auth::user()->name }}"
                            readonly
                            class="w-full mt-3 rounded-2xl border border-slate-300 bg-slate-100">
                    </div>
                    <div>
                        <label class="font-semibold">
                            Email
                        </label>
                        <input
                            type="email"
                            value="{{ Auth::user()->email }}"
                            readonly
                            class="w-full mt-3 rounded-2xl border border-slate-300 bg-slate-100">
                    </div>
                    <div>
                        <label class="font-semibold">
                            Jenis Donasi
                        </label>
                        <select
                            class="w-full mt-3 rounded-2xl border border-slate-300">
                            <option>Infak</option>
                            <option>Sedekah</option>
                            <option>Wakaf</option>
                            <option>Pembangunan</option>
                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">
                            Nominal
                        </label>
                        <input
                            type="number"
                            placeholder="100000"
                            class="w-full mt-3 rounded-2xl border border-slate-300">
                    </div>
                </div>
                <button
                    type="button"
                    class="mt-10 w-full py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-lg">
                    <i class="fa-solid fa-paper-plane mr-2"></i>
                    Kirim Donasi
                </button>
            </form>
        </div>
    </section>

    @include('partials.footer')

</body>

</html>