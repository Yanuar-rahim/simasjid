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

    <section id="riwayat" class="py-24 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                <div>
                    <span class="text-emerald-600 font-semibold">
                        Riwayat Donasi
                    </span>
                    <h2 class="text-4xl font-bold mt-2">
                        Aktivitas Donasi Anda
                    </h2>
                    <p class="text-slate-500 mt-4">
                        Berikut riwayat donasi yang pernah Anda lakukan melalui SIMASJID.
                    </p>
                </div>
                <button 
                    class="px-6 py-3 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-download mr-2"></i>
                    Download Bukti
                </button>
            </div>
            <div class="grid lg:grid-cols-3 gap-8 mt-14">
                <!-- Tabel -->
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-emerald-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-4 text-left">
                                        Jenis
                                    </th>
                                    <th class="px-6 py-4 text-left">
                                        Nominal
                                    </th>
                                    <th class="px-6 py-4 text-left">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-5">
                                        10 Juli 2026
                                    </td>
                                    <td class="px-6 py-5">
                                        Infak
                                    </td>
                                    <td class="px-6 py-5 font-semibold">
                                        Rp100.000
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                            Diterima
                                        </span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-5">
                                        06 Juli 2026
                                    </td>
                                    <td class="px-6 py-5">
                                        Sedekah
                                    </td>
                                    <td class="px-6 py-5 font-semibold">
                                        Rp50.000
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                            Menunggu
                                        </span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-5">
                                        01 Juli 2026
                                    </td>
                                    <td class="px-6 py-5">
                                        Wakaf
                                    </td>
                                    <td class="px-6 py-5 font-semibold">
                                        Rp500.000
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                            Diterima
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Progress -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold">
                        Statistik Donasi
                    </h3>
                    <div class="mt-10 space-y-8">
                        <div>
                            <div class="flex justify-between mb-3">
                                <span>Total Target</span>
                                <span class="font-semibold">
                                    Rp10.000.000
                                </span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-4">
                                <div class="bg-emerald-600 h-4 rounded-full w-3/4"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-3">
                                <span>Terkumpul</span>
                                <span class="font-semibold text-emerald-600">
                                    Rp7.500.000
                                </span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-4">
                                <div class="bg-blue-500 h-4 rounded-full w-2/3"></div>
                            </div>
                        </div>
                        <div class="bg-emerald-50 rounded-2xl p-6 mt-10">
                            <i class="fa-solid fa-heart text-emerald-600 text-3xl"></i>
                            <h4 class="font-bold text-xl mt-4">
                                Terima Kasih
                            </h4>
                            <p class="text-slate-600 leading-8 mt-3">
                                Semoga Allah SWT membalas setiap amal baik yang telah Anda berikan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>

</html>