<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->judul }} | SIMASJID</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50">

    {{-- Navbar --}}
    @include('partials.navbar')

    <!-- Hero -->

    <section class="pt-36 pb-20 bg-gradient-to-r from-emerald-700 to-emerald-600 text-white">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <a
                href="{{ route('home') }}#kegiatan"
                class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-white text-emerald-700 font-semibold shadow-md hover:bg-emerald-50 hover:shadow-lg transition-all duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                <span>Kembali ke Kegiatan</span>

            </a>

            <span
                class="inline-flex px-5 py-2 rounded-full bg-white/20">

                {{ $kegiatan->status }}

            </span>

            <h1
                class="mt-6 text-5xl font-bold leading-tight">

                {{ $kegiatan->judul }}

            </h1>

            <div
                class="flex flex-wrap gap-8 mt-8 text-emerald-100">

                <div>

                    <i class="fa-solid fa-calendar"></i>

                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}

                </div>

                <div>

                    <i class="fa-solid fa-clock"></i>

                    {{ date('H:i',strtotime($kegiatan->jam)) }} WIB

                </div>

                <div>

                    <i class="fa-solid fa-location-dot"></i>

                    {{ $kegiatan->lokasi }}

                </div>

            </div>

        </div>

    </section>

    <!-- Content -->

    <section class="py-20">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <div class="grid lg:grid-cols-3 gap-10">

                <!-- Kiri -->

                <div class="lg:col-span-2">

                    <div
                        class="bg-white rounded-3xl shadow-lg overflow-hidden">

                        <img
                            src="{{ asset('storage/'.$kegiatan->gambar) }}"
                            class="w-full h-[520px] object-cover">

                        <div class="p-10">

                            <h2 class="text-3xl font-bold">

                                Tentang Kegiatan

                            </h2>

                            <div
                                class="mt-8 leading-9 text-slate-600 text-lg">

                                {!! nl2br(e($kegiatan->deskripsi)) !!}

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Sidebar -->

                <div>

                    <div
                        class="bg-white rounded-3xl shadow-lg p-8 top-28">

                        <h3
                            class="text-2xl font-bold">

                            Informasi

                        </h3>

                        <div
                            class="mt-8 space-y-6">

                            <div>

                                <small class="text-slate-500">

                                    Tanggal

                                </small>

                                <h4 class="font-semibold mt-1">

                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}

                                </h4>

                            </div>

                            <div>

                                <small class="text-slate-500">

                                    Jam

                                </small>

                                <h4 class="font-semibold mt-1">

                                    {{ date('H:i',strtotime($kegiatan->jam)) }} WIB

                                </h4>

                            </div>

                            <div>

                                <small class="text-slate-500">

                                    Lokasi

                                </small>

                                <h4 class="font-semibold mt-1">

                                    {{ $kegiatan->lokasi }}

                                </h4>

                            </div>

                            <div>

                                <small class="text-slate-500">

                                    Pemateri

                                </small>

                                <h4 class="font-semibold mt-1">

                                    {{ $kegiatan->pemateri ?: '-' }}

                                </h4>

                            </div>

                            <div>

                                <small class="text-slate-500">

                                    Status

                                </small>

                                <br>

                                <span
                                    class="inline-flex mt-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-700">

                                    {{ $kegiatan->status }}

                                </span>

                            </div>

                        </div>

                        <!-- <a
                            href="{{ route('home') }}#donasi"
                            class="btn-primary w-full mt-10 text-center">

                            <i class="fa-solid fa-hand-holding-heart mr-2"></i>

                            Donasi Sekarang

                        </a> -->

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Kegiatan lainnya -->

    <section class="pb-24">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <div class="flex justify-between items-center">

                <div>

                    <span class="text-emerald-700 font-semibold">

                        Program Masjid

                    </span>

                    <h2 class="title mt-2">

                        Kegiatan Lainnya

                    </h2>

                </div>

                <a
                    href="{{ route('user.kegiatan') }}"
                    class="btn-secondary">

                    Lihat Semua

                </a>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">

                @foreach($lainnya as $item)

                <div
                    class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 duration-500">

                    <img
                        src="{{ asset('storage/'.$item->gambar) }}"
                        class="w-full h-56 object-cover">

                    <div class="p-6">

                        <h3 class="font-bold text-xl">

                            {{ $item->judul }}

                        </h3>

                        <p class="mt-3 text-slate-500">

                            {{ Str::limit($item->deskripsi,80) }}

                        </p>

                        <a
                            href="{{ route('public.kegiatan.detail',$item->slug) }}"
                            class="mt-8 block w-full py-3 rounded-2xl bg-emerald-600 text-white text-center hover:bg-emerald-700">

                            Selengkapnya

                        </a>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    {{-- Footer --}}
    @include('partials.footer')

</body>

</html>