@extends('layouts.app')

@section('content')

<!-- ================= HERO ================= -->

<section
    class="relative overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-600 text-white pt-36 pb-24">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-white blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-emerald-300 blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- ================= LEFT ================= -->

            <div>

                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/20 backdrop-blur">
                    <i class="fa-solid fa-circle-check"></i>
                    Login Berhasil
                </span>

                <h1
                    class="mt-8 text-5xl lg:text-6xl font-bold leading-tight">
                    Assalamu'alaikum,
                    <br>
                    {{ Auth::user()->name }}
                </h1>

                <p
                    class="mt-8 text-xl leading-9 text-emerald-100">
                    Terima kasih telah menjadi bagian dari keluarga besar
                    <strong>SIMASJID</strong>.
                    Mari bersama-sama memakmurkan masjid melalui
                    donasi digital, mengikuti kegiatan, serta memperoleh
                    informasi terbaru secara transparan.
                </p>
                <div
                    class="mt-10 flex flex-wrap gap-4">

                    <a
                        href="#donasi"
                        class="px-8 py-4 rounded-2xl bg-white text-emerald-700 font-semibold hover:scale-105 duration-300">
                        <i class="fa-solid fa-hand-holding-heart mr-2"></i>
                        Donasi Sekarang
                    </a>

                    <a
                        href="#riwayat"
                        class="px-8 py-4 rounded-2xl border border-white/30 backdrop-blur hover:bg-white/10">
                        <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                        Riwayat Donasi
                    </a>
                </div>
            </div>

            <!-- ================= RIGHT ================= -->

            <div class="flex justify-center lg:justify-end">
                <div
                    class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md text-slate-700">
                    <div
                        class="flex items-center gap-4">

                        @if(Auth::user()->foto)

                        <img
                            src="{{ asset('storage/'.Auth::user()->foto) }}"
                            class="w-20 h-20 rounded-full object-cover">

                        @else

                        <div
                            class="w-20 h-20 rounded-full bg-emerald-600 text-white flex items-center justify-center text-3xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                        @endif
                        <div>

                            <h2
                                class="text-2xl font-bold">
                                {{ Auth::user()->name }}
                            </h2>

                            <p
                                class="text-slate-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-8">

                    <div class="space-y-6">

                        <div class="flex justify-between">
                            <span>Total Donasi</span>
                            <strong>
                                Rp
                                {{ number_format($totalDonasi ?? 0,0,',','.') }}
                            </strong>
                        </div>

                        <div class="flex justify-between">
                            <span>Total Transaksi</span>
                            <strong>
                                {{ $totalTransaksi ?? 0 }}
                            </strong>
                        </div>

                        <div class="flex justify-between">
                            <span>Donasi Diterima</span>
                            <strong>
                                {{ $donasiDiterima ?? 0 }}
                            </strong>
                        </div>

                        <div class="flex justify-between">
                            <span>Status Akun</span>
                            <span
                                class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= STATISTIK ================= -->

<section class="py-20 bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div
            class="grid md:grid-cols-2 xl:grid-cols-4 gap-8">

            <!-- Card -->

            <div
                class="bg-white rounded-3xl p-8 shadow hover:-translate-y-2 duration-300">
                <div
                    class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="fa-solid fa-wallet text-emerald-600 text-2xl"></i>
                </div>

                <h3
                    class="mt-6 text-4xl font-bold">
                    Rp{{ number_format($totalDonasi ?? 0,0,',','.') }}
                </h3>

                <p
                    class="text-slate-500 mt-2">
                    Total Donasi Anda
                </p>
            </div>

            <div
                class="bg-white rounded-3xl p-8 shadow hover:-translate-y-2 duration-300">
                <div
                    class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i class="fa-solid fa-receipt text-blue-600 text-2xl"></i>
                </div>

                <h3
                    class="mt-6 text-4xl font-bold">
                    {{ $totalTransaksi ?? 0 }}
                </h3>

                <p
                    class="text-slate-500 mt-2">
                    Total Transaksi
                </p>
            </div>

            <div
                class="bg-white rounded-3xl p-8 shadow hover:-translate-y-2 duration-300">
                <div
                    class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center">
                    <i class="fa-solid fa-clock text-yellow-500 text-2xl"></i>
                </div>

                <h3
                    class="mt-6 text-4xl font-bold">
                    {{ $menunggu ?? 0 }}
                </h3>

                <p
                    class="text-slate-500 mt-2">
                    Menunggu Verifikasi
                </p>
            </div>
            <div
                class="bg-white rounded-3xl p-8 shadow hover:-translate-y-2 duration-300">

                <div
                    class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-red-500 text-2xl"></i>
                </div>

                <h3
                    class="mt-6 text-4xl font-bold">
                    {{ $kegiatan->count() }}
                </h3>
                <p
                    class="text-slate-500 mt-2">
                    Kegiatan Aktif
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= QUICK MENU ================= -->

<section class="pb-20 bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div
            class="grid md:grid-cols-4 gap-6">

            <a href="#donasi"
                class="bg-white rounded-3xl p-8 text-center shadow hover:bg-emerald-600 hover:text-white duration-300">
                <i class="fa-solid fa-hand-holding-heart text-4xl"></i>
                <h3 class="mt-5 font-bold">
                    Donasi
                </h3>
            </a>

            <a href="#kegiatan"
                class="bg-white rounded-3xl p-8 text-center shadow hover:bg-emerald-600 hover:text-white duration-300">
                <i class="fa-solid fa-calendar-days text-4xl"></i>
                <h3 class="mt-5 font-bold">
                    Kegiatan
                </h3>
            </a>

            <a href="#pengumuman"
                class="bg-white rounded-3xl p-8 text-center shadow hover:bg-emerald-600 hover:text-white duration-300">
                <i class="fa-solid fa-bullhorn text-4xl"></i>
                <h3 class="mt-5 font-bold">
                    Pengumuman
                </h3>
            </a>

            <a href="#riwayat"
                class="bg-white rounded-3xl p-8 text-center shadow hover:bg-emerald-600 hover:text-white duration-300">
                <i class="fa-solid fa-clock-rotate-left text-4xl"></i>
                <h3 class="mt-5 font-bold">
                    Riwayat
                </h3>
            </a>
        </div>
    </div>
</section>

<!-- ================= TENTANG ================= -->

<section class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Gambar -->

            <div>

                <img
                    src="{{ asset('assets/images/hero-masjid.png') }}"
                    class="rounded-3xl shadow-2xl w-full">

            </div>

            <!-- Konten -->

            <div>

                <span class="text-emerald-600 font-semibold uppercase tracking-widest">

                    Tentang SIMASJID

                </span>

                <h2 class="text-5xl font-bold mt-5 leading-tight">

                    Sistem Informasi Manajemen Masjid Modern

                </h2>

                <p class="mt-8 text-slate-600 leading-9 text-lg">

                    SIMASJID merupakan platform digital yang membantu
                    pengelolaan kegiatan masjid, donasi,
                    transparansi keuangan,
                    serta komunikasi antara pengurus dan jamaah.

                </p>

                <div class="grid grid-cols-2 gap-8 mt-10">

                    <div>

                        <h3 class="text-4xl font-bold text-emerald-600">

                            {{ $kegiatan->count() }}+

                        </h3>

                        <p class="mt-2 text-slate-500">

                            Kegiatan Aktif

                        </p>

                    </div>

                    <div>

                        <h3 class="text-4xl font-bold text-emerald-600">

                            {{ $pengumuman->count() }}+

                        </h3>

                        <p class="mt-2 text-slate-500">

                            Pengumuman

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= KEGIATAN ================= -->

<section id="kegiatan" class="py-24 bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="flex justify-between items-center">

            <div>

                <span class="text-emerald-600 font-semibold">

                    Program Masjid

                </span>

                <h2 class="text-4xl font-bold mt-3">

                    Kegiatan Terbaru

                </h2>

            </div>

            <a
                href="#"
                class="text-emerald-600 font-semibold">

                Lihat Semua →

            </a>

        </div>

        <div class="grid lg:grid-cols-3 gap-8 mt-14">

            @foreach($kegiatan as $item)

            <div
                class="bg-white rounded-3xl overflow-hidden shadow-lg hover:-translate-y-3 transition duration-500">

                <img
                    src="{{ asset('storage/'.$item->gambar) }}"
                    class="w-full h-60 object-cover">

                <div class="p-7">

                    <span
                        class="inline-flex px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-sm">

                        {{ $item->status }}

                    </span>

                    <h3
                        class="mt-5 text-2xl font-bold">

                        {{ $item->judul }}

                    </h3>

                    <div class="space-y-3 mt-6 text-slate-500">

                        <div>

                            <i class="fa-solid fa-calendar mr-2"></i>

                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                        </div>

                        <div>

                            <i class="fa-solid fa-clock mr-2"></i>

                            {{ date('H:i',strtotime($item->jam)) }}

                        </div>

                        <div>

                            <i class="fa-solid fa-location-dot mr-2"></i>

                            {{ $item->lokasi }}

                        </div>

                    </div>

                    <p
                        class="mt-6 text-slate-600">

                        {{ Str::limit($item->deskripsi,100) }}

                    </p>

                    <a
                        href="{{ route('kegiatan.detail',$item->slug) }}"
                        class="inline-flex items-center gap-2 mt-8 text-emerald-600 font-semibold">

                        Selengkapnya

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- ================= PENGUMUMAN ================= -->

<section id="pengumuman" class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="flex justify-between items-center">

            <div>

                <span class="text-emerald-600 font-semibold">

                    Informasi Masjid

                </span>

                <h2 class="text-4xl font-bold mt-3">

                    Pengumuman Terbaru

                </h2>

            </div>

        </div>

        <div class="grid lg:grid-cols-3 gap-8 mt-14">

            @foreach($pengumuman as $item)

            <div
                class="bg-slate-50 rounded-3xl overflow-hidden shadow hover:shadow-xl transition duration-500">

                <img
                    src="{{ asset('storage/'.$item->gambar) }}"
                    class="w-full h-56 object-cover">

                <div class="p-7">

                    <span
                        class="inline-flex px-4 py-2 rounded-full bg-emerald-100 text-emerald-700">

                        {{ $item->kategori }}

                    </span>

                    <h3
                        class="mt-5 text-2xl font-bold">

                        {{ $item->judul }}

                    </h3>

                    <p
                        class="mt-5 text-slate-600">

                        {{ Str::limit(strip_tags($item->isi),120) }}

                    </p>

                    <a
                        href="{{ route('pengumuman.detail',$item->slug) }}"
                        class="inline-flex items-center gap-2 mt-8 text-emerald-600 font-semibold">

                        Baca Selengkapnya

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- ================= DONASI ================= -->

<section id="donasi" class="py-24 bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="text-center">

            <span class="text-emerald-600 font-semibold uppercase tracking-widest">

                Donasi Digital

            </span>

            <h2 class="text-5xl font-bold mt-4">

                Mari Berbagi Kebaikan

            </h2>

            <p class="mt-6 text-slate-600 max-w-3xl mx-auto leading-8">

                Seluruh donasi yang Anda berikan akan digunakan
                untuk pembangunan, operasional,
                dan kegiatan Masjid secara transparan.

            </p>

        </div>

        <div class="grid lg:grid-cols-3 gap-10 mt-16">

            <!-- ================= FORM ================= -->

            <div class="lg:col-span-2">

                <div class="bg-white rounded-3xl shadow-xl p-10">

                    <form
                        action="{{ route('donasi.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>

                                <label class="font-semibold">

                                    Nama Donatur

                                </label>

                                <input
                                    type="text"
                                    value="{{ Auth::user()->name }}"
                                    readonly
                                    class="w-full mt-2 rounded-2xl border bg-slate-100 px-5 py-3">

                            </div>

                            <div>

                                <label class="font-semibold">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    value="{{ Auth::user()->email }}"
                                    readonly
                                    class="w-full mt-2 rounded-2xl border bg-slate-100 px-5 py-3">

                            </div>

                            <div>

                                <label class="font-semibold">

                                    Nomor HP

                                </label>

                                <input
                                    type="text"
                                    name="no_hp"
                                    value="{{ Auth::user()->phone }}"
                                    readonly
                                    class="w-full mt-2 rounded-2xl border bg-slate-100 px-5 py-3">

                            </div>

                            <div>

                                <label class="font-semibold">

                                    Jenis Donasi

                                </label>

                                <select
                                    name="jenis_donasi"
                                    required
                                    class="w-full mt-2 rounded-2xl border px-5 py-3">

                                    <option value="">Pilih</option>

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
                                    name="nominal"
                                    placeholder="100000"
                                    required
                                    class="w-full mt-2 rounded-2xl border px-5 py-3">

                            </div>

                            <div>

                                <label class="font-semibold">

                                    Metode Pembayaran

                                </label>

                                <select
                                    name="metode"
                                    required
                                    class="w-full mt-2 rounded-2xl border px-5 py-3">

                                    <option value="">Pilih</option>

                                    <option>Transfer Bank</option>

                                    <option>QRIS</option>

                                    <option>Tunai</option>

                                </select>

                            </div>

                        </div>

                        <div class="mt-8">

                            <label class="font-semibold">

                                Upload Bukti Transfer

                            </label>

                            <input
                                type="file"
                                name="bukti_transfer"
                                class="w-full mt-2 rounded-2xl border p-3">

                        </div>

                        <div class="mt-8">

                            <label class="font-semibold">

                                Doa / Pesan

                            </label>

                            <textarea
                                name="doa"
                                rows="5"
                                class="w-full mt-2 rounded-2xl border px-5 py-3"
                                placeholder="Tuliskan doa atau pesan Anda..."></textarea>

                        </div>

                        <button
                            class="mt-10 w-full py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-lg">

                            <i class="fa-solid fa-paper-plane mr-2"></i>

                            Kirim Donasi

                        </button>

                    </form>

                </div>

            </div>

            <!-- ================= SIDEBAR ================= -->

            <div>

                <div class="bg-white rounded-3xl shadow-xl p-8 sticky top-28">

                    <h3 class="text-2xl font-bold">

                        Informasi Rekening

                    </h3>

                    <div class="space-y-6 mt-8">

                        <div>

                            <small class="text-slate-500">

                                Bank BSI

                            </small>

                            <h4 class="font-bold text-xl">

                                7123456789

                            </h4>

                            <p class="text-slate-500">

                                a.n DKM Masjid

                            </p>

                        </div>

                        <hr>

                        <div>

                            <small class="text-slate-500">

                                Bank BRI

                            </small>

                            <h4 class="font-bold text-xl">

                                001234567890

                            </h4>

                            <p class="text-slate-500">

                                a.n DKM Masjid

                            </p>

                        </div>

                        <hr>

                        <div>

                            <small class="text-slate-500">

                                QRIS

                            </small>

                            <img
                                src="{{ asset('assets/images/qris.png') }}"
                                class="rounded-2xl mt-4">

                        </div>

                    </div>

                    <div
                        class="mt-10 rounded-2xl bg-emerald-50 p-6">

                        <h4 class="font-bold">

                            Keamanan Donasi

                        </h4>

                        <p class="mt-3 text-slate-600 leading-7">

                            Semua transaksi akan diverifikasi
                            oleh admin sebelum dinyatakan diterima.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= RIWAYAT DONASI ================= -->

<section id="riwayat" class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="flex justify-between items-center mb-12">

            <div>

                <span class="text-emerald-600 font-semibold">

                    Donasi Saya

                </span>

                <h2 class="text-4xl font-bold mt-3">

                    Riwayat Donasi

                </h2>

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-100">

                        <tr>

                            <th class="px-6 py-5 text-left">Tanggal</th>

                            <th class="px-6 py-5 text-left">Jenis</th>

                            <th class="px-6 py-5 text-left">Nominal</th>

                            <th class="px-6 py-5 text-left">Metode</th>

                            <th class="px-6 py-5 text-center">Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($riwayatDonasi as $item)

                        <tr class="border-b hover:bg-slate-50">

                            <td class="px-6 py-5">

                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                            </td>

                            <td class="px-6 py-5">

                                {{ $item->jenis_donasi }}

                            </td>

                            <td class="px-6 py-5 font-semibold text-emerald-700">

                                Rp {{ number_format($item->nominal,0,',','.') }}

                            </td>

                            <td class="px-6 py-5">

                                {{ $item->metode }}

                            </td>

                            <td class="px-6 py-5 text-center">

                                @if($item->status=='Menunggu')

                                <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">

                                    Menunggu

                                </span>

                                @elseif($item->status=='Diterima')

                                <span class="px-4 py-2 rounded-full bg-emerald-100 text-emerald-700">

                                    Diterima

                                </span>

                                @else

                                <span class="px-4 py-2 rounded-full bg-red-100 text-red-700">

                                    Ditolak

                                </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-12 text-slate-500">

                                Belum ada riwayat donasi.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

<section class="py-24 bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white rounded-3xl p-8 shadow">

                <h3 class="text-5xl font-bold text-emerald-600">

                    {{ $donasiDiterima }}

                </h3>

                <p class="mt-3 text-slate-500">

                    Donasi Diterima

                </p>

            </div>

            <div class="bg-white rounded-3xl p-8 shadow">

                <h3 class="text-5xl font-bold text-yellow-500">

                    {{ $menunggu }}

                </h3>

                <p class="mt-3 text-slate-500">

                    Menunggu Verifikasi

                </p>

            </div>

            <div class="bg-white rounded-3xl p-8 shadow">

                <h3 class="text-5xl font-bold text-red-500">

                    {{ $ditolak }}

                </h3>

                <p class="mt-3 text-slate-500">

                    Ditolak

                </p>

            </div>

        </div>

    </div>

</section>

<section class="py-24 bg-white">

    <div class="max-w-4xl mx-auto px-6">

        <div class="text-center">

            <h2 class="text-4xl font-bold">

                Pertanyaan Umum

            </h2>

        </div>

        <div class="mt-12 space-y-6">

            <div class="bg-slate-50 rounded-2xl p-6">

                <h4 class="font-bold">

                    Kapan donasi saya diverifikasi?

                </h4>

                <p class="mt-3 text-slate-600">

                    Maksimal 1x24 jam setelah bukti transfer dikirim.

                </p>

            </div>

            <div class="bg-slate-50 rounded-2xl p-6">

                <h4 class="font-bold">

                    Apakah donasi saya aman?

                </h4>

                <p class="mt-3 text-slate-600">

                    Ya, seluruh transaksi diverifikasi oleh admin dan tercatat pada sistem.

                </p>

            </div>

            <div class="bg-slate-50 rounded-2xl p-6">

                <h4 class="font-bold">

                    Apakah saya bisa melihat riwayat donasi?

                </h4>

                <p class="mt-3 text-slate-600">

                    Semua riwayat donasi dapat dilihat pada halaman ini.

                </p>

            </div>

        </div>

    </div>

</section>

<section class="py-24 bg-gradient-to-r from-emerald-700 to-emerald-600 text-white">

    <div class="max-w-5xl mx-auto text-center px-6">

        <h2 class="text-5xl font-bold">

            Terima Kasih

        </h2>

        <p class="mt-8 text-xl leading-9">

            Semoga Allah SWT membalas setiap kebaikan
            yang telah Anda berikan kepada Masjid.

        </p>

        <a
            href="#donasi"
            class="inline-block mt-10 px-10 py-4 rounded-2xl bg-white text-emerald-700 font-bold hover:scale-105 duration-300">

            Donasi Lagi

        </a>

    </div>

</section>

@endsection

@include('partials.footer')