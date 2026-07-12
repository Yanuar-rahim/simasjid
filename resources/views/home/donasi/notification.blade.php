<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Donasi | SIMASJID</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('partials.navbar-user')

    <section class="pt-36 pb-24">
        <div class="max-w-4xl mx-auto px-8 sm:px-14 lg:px-20">
            <div class="bg-white rounded-[35px] shadow-xl p-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="fa-solid fa-bell text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">Notifikasi Donasi</h1>
                        <p class="text-slate-500 mt-1">Halaman ini menampilkan status callback Midtrans.</p>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl border border-slate-200 p-6 bg-slate-50">
                    @if($status)
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 font-semibold">
                            <i class="fa-solid fa-circle-check mr-2"></i>
                            Status: {{ $status }}
                        </div>
                        <p class="mt-4 text-slate-600">Order ID: <span class="font-semibold text-slate-800">{{ $orderId }}</span></p>
                    @else
                        <p class="text-slate-600">Belum ada data callback yang diterima.</p>
                    @endif
                </div>

                @if(!empty($payload))
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-slate-800">Payload Midtrans</h2>
                        <pre class="mt-4 overflow-x-auto rounded-2xl bg-slate-900 p-4 text-sm text-slate-100">{{ json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                    </div>
                @endif

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('user.riwayat') }}" class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                        <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                        Lihat Riwayat Donasi
                    </a>
                    <a href="{{ route('user.donasi') }}" class="px-5 py-3 rounded-2xl bg-white border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50 transition">
                        <i class="fa-solid fa-hand-holding-heart mr-2"></i>
                        Kembali ke Donasi
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
