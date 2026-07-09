<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $pengumuman->judul }} | SIMASJID</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-slate-50">

    {{-- Navbar --}}
    @include('partials.navbar')

    <!-- Hero -->

    <section class="pt-36 pb-20 bg-gradient-to-r from-emerald-700 to-emerald-600 text-white">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <a
                href="{{ route('home') }}#pengumuman"
                class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-white text-emerald-700 font-semibold shadow-md hover:bg-emerald-50 hover:shadow-lg transition-all duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                <span>Kembali ke Pengumuman</span>

            </a>

            <div class="mt-8">

                <span class="inline-flex px-5 py-2 rounded-full bg-white/20">

                    {{ $pengumuman->kategori }}

                </span>

            </div>

            <h1 class="mt-6 text-5xl font-bold leading-tight">

                {{ $pengumuman->judul }}

            </h1>

            <div class="flex flex-wrap gap-8 mt-8 text-emerald-100">

                <div>

                    <i class="fa-solid fa-calendar"></i>

                    {{ $pengumuman->created_at->translatedFormat('d F Y') }}

                </div>

                <div>

                    <i class="fa-solid fa-folder-open"></i>

                    {{ $pengumuman->kategori }}

                </div>

            </div>

        </div>

    </section>

    <!-- Content -->

    <section class="py-20">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <div class="grid lg:grid-cols-3 gap-10">

                <!-- Konten -->

                <div class="lg:col-span-2">

                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                        @if($pengumuman->gambar)

                        <img
                            src="{{ asset('storage/'.$pengumuman->gambar) }}"
                            class="w-full h-[520px] object-cover">

                        @endif

                        <div class="p-10">

                            <h2 class="text-3xl font-bold">

                                Detail Pengumuman

                            </h2>

                            <div class="mt-8 leading-9 text-slate-600 text-lg">

                                {!! nl2br(e($pengumuman->isi)) !!}

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Sidebar -->

                <div>

                    <div class="bg-white rounded-3xl shadow-lg p-8">

                        <h3 class="text-2xl font-bold">

                            Informasi

                        </h3>

                        <div class="mt-8 space-y-6">

                            <div>

                                <small class="text-slate-500">

                                    Tanggal Publikasi

                                </small>

                                <h4 class="font-semibold mt-1">

                                    {{ $pengumuman->created_at->translatedFormat('d F Y') }}

                                </h4>

                            </div>

                            <div>

                                <small class="text-slate-500">

                                    Kategori

                                </small>

                                <h4 class="font-semibold mt-1">

                                    {{ $pengumuman->kategori }}

                                </h4>

                            </div>

                            <div>

                                <small class="text-slate-500">

                                    Status

                                </small>

                                <br>

                                @if($pengumuman->status=='Aktif')

                                <span class="inline-flex mt-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-700">

                                    Aktif

                                </span>

                                @else

                                <span class="inline-flex mt-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">

                                    Draft

                                </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Pengumuman Lainnya -->

    <section class="pb-24">

        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">

            <div class="flex justify-between items-center">

                <div>

                    <span class="text-emerald-700 font-semibold">

                        Informasi Masjid

                    </span>

                    <h2 class="title mt-2">

                        Pengumuman Lainnya

                    </h2>

                </div>

                <a
                    href="{{ route('home') }}#pengumuman"
                    class="btn-secondary">

                    Lihat Semua

                </a>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">

                @foreach($pengumumanTerbaru as $item)

                <div
                    class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 duration-500">

                    <img
                        src="{{ asset('storage/'.$item->gambar) }}"
                        class="w-full h-56 object-cover">

                    <div class="p-6">

                        <span class="text-sm text-emerald-600 font-semibold">

                            {{ $item->kategori }}

                        </span>

                        <h3 class="font-bold text-xl mt-2">

                            {{ $item->judul }}

                        </h3>

                        <p class="mt-3 text-slate-500">

                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi),80) }}

                        </p>

                        <a
                            href="{{ route('pengumuman.detail',$item->slug) }}"
                            class="inline-flex items-center gap-2 mt-6 text-emerald-700 font-semibold hover:gap-3 transition-all">

                            Selengkapnya

                            <i class="fa-solid fa-arrow-right"></i>

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