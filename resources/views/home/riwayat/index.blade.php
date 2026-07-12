<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi | SIMASJID</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">

    @include('partials.navbar-user')

    @php
        $jenisColors = [
            'Infak' => 'bg-emerald-100 text-emerald-700',
            'Sedekah' => 'bg-blue-100 text-blue-700',
            'Wakaf' => 'bg-purple-100 text-purple-700',
            'Pembangunan' => 'bg-orange-100 text-orange-700',
        ];
        $distribusiColors = [
            'Infak' => 'bg-emerald-500',
            'Sedekah' => 'bg-blue-500',
            'Wakaf' => 'bg-purple-500',
            'Pembangunan' => 'bg-orange-500',
        ];
        $activeJenis = request('jenis');
    @endphp

    <!-- Hero -->
    <section class="pt-40 pb-24 bg-gradient-to-br from-emerald-700 via-emerald-600 to-green-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white/20">
                    <i class="fa-solid fa-clock-rotate-left text-5xl"></i>
                </div>
                <span class="block mt-6 font-semibold tracking-widest uppercase text-emerald-200">
                    Riwayat Donasi
                </span>
                <h1 class="text-5xl font-bold mt-4">
                    Aktivitas Donasi Anda
                </h1>
                <p class="max-w-3xl mx-auto mt-6 text-emerald-100 leading-8 text-lg">
                    Pantau seluruh riwayat donasi yang pernah Anda lakukan melalui SIMASJID.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-14" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white/20 backdrop-blur-xl rounded-3xl p-7 shadow-xl shadow-emerald-950/20">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-white">
                            <i class="fa-solid fa-wallet text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-emerald-50 text-sm">Total Donasi Diterima</p>
                            <h3 class="text-2xl font-bold mt-1 text-white">
                                Rp{{ number_format($totalDonasi, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white/20 backdrop-blur-xl rounded-3xl p-7 shadow-xl shadow-emerald-950/20">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-white">
                            <i class="fa-solid fa-receipt text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-emerald-50 text-sm">Jumlah Transaksi</p>
                            <h3 class="text-2xl font-bold mt-1 text-white">{{ $jumlahTransaksi }} Donasi</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white/20 backdrop-blur-xl rounded-3xl p-7 shadow-xl shadow-emerald-950/20">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-white">
                            <i class="fa-solid fa-calendar-check text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-emerald-50 text-sm">Donasi Terakhir</p>
                            <h3 class="text-2xl font-bold mt-1 text-white">
                                {{ $donasiTerakhir?->tanggal?->translatedFormat('d F Y') ?? '-' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Riwayat -->
    <section id="riwayat" class="py-20 bg-slate-50">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <!-- Filter -->
            <div class="flex flex-wrap items-center gap-3 mb-10" data-aos="fade-up">
                <a href="{{ route('user.riwayat') }}"
                    class="px-6 py-3 rounded-2xl font-semibold transition {{ ! $activeJenis ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'bg-white text-slate-600 shadow-md hover:bg-emerald-50 hover:text-emerald-700' }}">
                    Semua
                </a>
                @foreach($allowedJenis as $jenis)
                <a href="{{ route('user.riwayat', ['jenis' => $jenis]) }}"
                    class="px-6 py-3 rounded-2xl font-semibold transition {{ $activeJenis === $jenis ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'bg-white text-slate-600 shadow-md hover:bg-emerald-50 hover:text-emerald-700' }}">
                    {{ $jenis }}
                </a>
                @endforeach
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Tabel -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <div class="p-8 pb-0 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <h3 class="text-2xl font-bold text-slate-800">
                                <i class="fa-solid fa-list-check text-emerald-600 mr-3"></i>
                                Daftar Transaksi
                            </h3>
                            @if($donasi->total() > 0)
                            <span class="text-sm text-slate-400">
                                Menampilkan {{ $donasi->firstItem() }}–{{ $donasi->lastItem() }} dari {{ $donasi->total() }} data
                            </span>
                            @endif
                        </div>

                        @if($donasi->isEmpty())
                        <div class="text-center py-20 px-8">
                            <i class="fa-solid fa-receipt text-6xl text-slate-300"></i>
                            <h3 class="mt-5 text-2xl font-semibold text-slate-800">
                                Belum ada riwayat donasi
                            </h3>
                            <p class="text-slate-500 mt-2">
                                @if($activeJenis)
                                    Tidak ada donasi jenis {{ $activeJenis }}.
                                @else
                                    Mulai berdonasi untuk melihat riwayat transaksi Anda.
                                @endif
                            </p>
                            <a href="{{ route('user.donasi') }}"
                                class="inline-flex items-center gap-2 mt-8 px-8 py-4 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                                Donasi Sekarang
                            </a>
                        </div>
                        @else
                        <div class="overflow-x-auto mt-6">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-emerald-600 to-green-600 text-white">
                                        <th class="px-8 py-5 text-left text-sm font-semibold">No</th>
                                        <th class="px-6 py-5 text-left text-sm font-semibold">Tanggal</th>
                                        <th class="px-6 py-5 text-left text-sm font-semibold">Jenis</th>
                                        <th class="px-6 py-5 text-left text-sm font-semibold">Nominal</th>
                                        <th class="px-6 py-5 text-left text-sm font-semibold">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($donasi as $item)
                                    <tr class="hover:bg-emerald-50/50 transition-colors">
                                        <td class="px-8 py-5 text-slate-400 font-medium">
                                            {{ $donasi->firstItem() + $loop->index }}
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                                    <i class="fa-solid fa-calendar text-emerald-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-slate-800">
                                                        {{ $item->tanggal->translatedFormat('d F Y') }}
                                                    </p>
                                                    <p class="text-xs text-slate-400">
                                                        {{ $item->tanggal->format('H:i') }} WIB
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex px-4 py-1.5 rounded-full text-sm font-medium {{ $jenisColors[$item->jenis_donasi] ?? 'bg-slate-100 text-slate-700' }}">
                                                {{ $item->jenis_donasi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 font-bold text-slate-800">
                                            Rp{{ number_format($item->nominal, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($item->status === 'Menunggu')
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                                <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                                Menunggu
                                            </span>
                                            @elseif($item->status === 'Diterima')
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 text-sm font-medium">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                Diterima
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                                Ditolak
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($donasi->hasPages())
                        <div class="px-8 py-6 border-t border-slate-100">
                            {{ $donasi->links() }}
                        </div>
                        @endif
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-white rounded-3xl shadow-xl p-8">
                        <h3 class="text-2xl font-bold text-slate-800">
                            <i class="fa-solid fa-tags text-emerald-600 mr-2"></i>
                            Distribusi Donasi
                        </h3>

                        @if($distribusi->isEmpty())
                        <p class="mt-6 text-slate-500">
                            Belum ada data distribusi donasi.
                        </p>
                        @else
                        <div class="mt-8 space-y-5">
                            @foreach($allowedJenis as $jenis)
                            @if($distribusi->has($jenis))
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full {{ $distribusiColors[$jenis] }}"></span>
                                    <span class="text-slate-600">{{ $jenis }}</span>
                                </div>
                                <span class="font-bold text-slate-800">{{ $distribusi[$jenis] }} kali</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <div class="rounded-3xl bg-gradient-to-br from-emerald-600 to-green-700 p-8 text-white">
                        <i class="fa-solid fa-heart text-4xl opacity-80"></i>
                        <h3 class="text-2xl font-bold mt-5">
                            Jazakallahu Khairan
                        </h3>
                        <p class="mt-4 text-emerald-100 leading-8">
                            Semoga Allah SWT membalas setiap amal baik yang telah Anda berikan.
                        </p>
                        <a href="{{ route('user.donasi') }}"
                            class="inline-flex items-center gap-2 mt-6 px-6 py-3 rounded-2xl bg-white/20 hover:bg-white/30 font-semibold transition">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            Donasi Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>

</html>
