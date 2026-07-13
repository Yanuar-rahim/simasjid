<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->judul }} | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-50">

    @include('partials.navbar-user')

    <section class="pt-40 pb-20 bg-gradient-to-r from-emerald-700 to-emerald-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex flex-wrap gap-3">
                <button type="button" onclick="window.history.back()" class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-white/10 text-white font-semibold border border-white/30 hover:bg-white/20 transition-all duration-300">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali</span>
                </button>

                <a href="{{ route('user.kegiatan') }}" class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-white text-emerald-700 font-semibold shadow-md hover:bg-emerald-50 transition-all duration-300">
                    <i class="fa-solid fa-list"></i>
                    <span>Lihat Semua Kegiatan</span>
                </a>
            </div>

            <h1 class="mt-8 text-4xl sm:text-5xl font-bold leading-tight">{{ $kegiatan->judul }}</h1>

            <div class="flex flex-wrap gap-6 mt-8 text-emerald-100">
                <div><i class="fa-solid fa-calendar mr-2"></i>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}</div>
                <div><i class="fa-solid fa-clock mr-2"></i>{{ date('H:i', strtotime($kegiatan->jam)) }} WIB</div>
                <div><i class="fa-solid fa-location-dot mr-2"></i>{{ $kegiatan->lokasi }}</div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden" data-aos="fade-up">
                        <img src="{{ asset('storage/'.$kegiatan->gambar) }}" class="w-full h-[420px] object-cover">
                        <div class="p-8">
                            <h2 class="text-3xl font-bold">Tentang Kegiatan</h2>
                            <div class="mt-6 leading-8 text-slate-600 text-lg">
                                {!! nl2br(e($kegiatan->deskripsi)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-2xl font-bold">Informasi</h3>
                        <div class="mt-8 space-y-6 text-slate-600">
                            <div>
                                <small class="text-slate-500">Tanggal</small>
                                <h4 class="font-semibold mt-1">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}</h4>
                            </div>
                            <div>
                                <small class="text-slate-500">Jam</small>
                                <h4 class="font-semibold mt-1">{{ date('H:i', strtotime($kegiatan->jam)) }} WIB</h4>
                            </div>
                            <div>
                                <small class="text-slate-500">Lokasi</small>
                                <h4 class="font-semibold mt-1">{{ $kegiatan->lokasi }}</h4>
                            </div>
                            <div>
                                <small class="text-slate-500">Pemateri</small>
                                <h4 class="font-semibold mt-1">{{ $kegiatan->pemateri ?: '-' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-24">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-emerald-700 font-semibold">Program Masjid</span>
                    <h2 class="text-3xl font-bold mt-2">Kegiatan Lainnya</h2>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                @foreach($lainnya as $item)
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:-translate-y-2 transition duration-300" data-aos="fade-up">
                        <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl">{{ $item->judul }}</h3>
                            <p class="mt-3 text-slate-500">{{ Str::limit($item->deskripsi, 80) }}</p>
                            <a href="{{ route('user.kegiatan.detail', $item->slug) }}" class="inline-flex items-center gap-2 mt-6 text-emerald-700 font-semibold hover:gap-3 transition-all">
                                Selengkapnya
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>
