<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-50">

    @include('partials.navbar-user')

    <section class="pt-40 pb-20 bg-gradient-to-r from-emerald-700 to-emerald-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="max-w-3xl" data-aos="fade-up">
                <span class="inline-flex px-5 py-2 rounded-full bg-white/20 text-sm font-semibold">
                    Dashboard Jamaah
                </span>
                <h1 class="mt-6 text-4xl sm:text-5xl font-bold leading-tight">
                    Pengumuman
                </h1>
                <p class="mt-5 text-lg text-emerald-100 leading-8">
                    Dapatkan informasi terbaru, pengumuman penting, dan berita dari pengurus masjid.
                </p>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($pengumuman ?? [] as $index => $item)
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:-translate-y-2 transition duration-300" data-aos="fade-up" @if($index > 0) data-aos-delay="{{ $index * 100 }}" @endif>
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : asset('assets/images/no-image.png') }}" class="w-full h-56 object-cover">
                        <div class="p-7">
                            <span class="inline-flex px-4 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                                {{ $item->kategori }}
                            </span>
                            <h3 class="font-bold text-2xl mt-5">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-slate-500 leading-8 mt-4">
                                {{ Str::limit(strip_tags($item->isi), 100) }}
                            </p>
                            <a href="{{ route('user.pengumuman.detail', $item->slug) }}" class="mt-8 inline-flex items-center gap-2 text-emerald-600 font-semibold">
                                Selengkapnya
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <i class="fa-solid fa-bullhorn text-6xl text-slate-300"></i>
                        <h3 class="mt-5 text-2xl font-semibold">Belum ada pengumuman</h3>
                        <p class="text-slate-500 mt-2">Pengumuman terbaru akan tampil di sini.</p>
                    </div>
                @endforelse
            </div>

            @if(($pengumuman ?? collect())->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-3 py-3 shadow-sm">
                        {{ $pengumuman->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')

</body>
</html>
