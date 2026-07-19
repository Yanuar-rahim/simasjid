@extends('layouts.admin')
@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Profil Masjid
            </h1>
            <p class="text-slate-500 mt-2">
                Kelola informasi utama masjid yang akan ditampilkan pada website.
            </p>
        </div>
    </div>
    <form
        action="{{ route('masjid.save') }}"
        method="POST"
        class="space-y-8">
        @csrf
        {{-- Informasi Masjid --}}
        <div class="dashboard-card">
            <h2 class="text-xl font-bold text-slate-800 mb-8">
                Informasi Masjid
            </h2>
            <div class="grid grid-cols-2 gap-6">
                {{-- Nama Masjid --}}
                <div>
                    <label class="block mb-2 font-medium text-slate-700">
                        Nama Masjid
                    </label>
                    <input
                        type="text"
                        name="nama_masjid"
                        value="{{ old('nama_masjid', $masjid?->nama_masjid) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600"
                        placeholder="Masukkan nama masjid">
                </div>
                {{-- Ketua Takmir --}}
                <div>
                    <label class="block mb-2 font-medium text-slate-700">
                        Ketua Takmir
                    </label>
                    <input
                        type="text"
                        name="ketua_takmir"
                        value="{{ old('ketua_takmir', $masjid?->ketua_takmir) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600"
                        placeholder="Nama Ketua Takmir">
                </div>
                {{-- Telepon --}}
                <div>
                    <label class="block mb-2 font-medium text-slate-700">
                        Telepon
                    </label>
                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon', $masjid?->telepon) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600"
                        placeholder="08xxxxxxxxxx">
                </div>
                {{-- Email --}}
                <div>
                    <label class="block mb-2 font-medium text-slate-700">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $masjid?->email) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600"
                        placeholder="email@masjid.com">
                </div>
            </div>
        </div>
            {{-- =========================
        Alamat Masjid
    ========================== --}}
    <div class="dashboard-card">
        <h2 class="text-xl font-bold text-slate-800 mb-8">
            Alamat Masjid
        </h2>
        <div>
            <label class="block mb-2 font-medium text-slate-700">
                Alamat Lengkap
            </label>
            <textarea
                name="alamat"
                rows="4"
                class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600 resize-none"
                placeholder="Masukkan alamat lengkap masjid">{{ old('alamat', $masjid?->alamat) }}</textarea>
        </div>
    </div>
    {{-- =========================
        Visi Masjid
    ========================== --}}
    <div class="dashboard-card">
        <h2 class="text-xl font-bold text-slate-800 mb-8">
            Visi
        </h2>
        <textarea
            name="visi"
            rows="5"
            class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600 resize-none"
            placeholder="Tuliskan visi masjid">{{ old('visi', $masjid?->visi) }}</textarea>
    </div>
    {{-- =========================
        Misi Masjid
    ========================== --}}
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Misi
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Tulis satu misi pada setiap baris.
                </p>
            </div>
        </div>
        <textarea
            name="misi"
            rows="8"
            class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600"
            placeholder="Contoh:
                        Meningkatkan kualitas ibadah.
                        Meningkatkan pelayanan jamaah.
                        Mewujudkan pengelolaan keuangan yang transparan.">{{ old('misi', $masjid?->misi) }}</textarea>
    </div>
    {{-- =========================
        Google Maps
    ========================== --}}
    <div class="dashboard-card">
        <h2 class="text-xl font-bold text-slate-800 mb-6">
            Google Maps
        </h2>
        <div class="space-y-6">
            <div>
                <label class="block mb-2 font-medium text-slate-700">
                    Link Embed Google Maps
                </label>
                <textarea
                    name="google_maps"
                    rows="4"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600 resize-none"
                    placeholder="Paste link embed Google Maps di sini">{{ old('google_maps', $masjid?->google_maps) }}</textarea>
            </div>
            <div>
                <label class="block mb-3 font-medium text-slate-700">
                    Preview Google Maps
                </label>
                @if($masjid && $masjid->google_maps)
                    <iframe
                        class="rounded-3xl shadow-lg w-full h-96"
                        src="{{ $masjid->google_maps }}"
                        loading="lazy">
                    </iframe>
                @else
                    <div
                        class="h-96 rounded-3xl border-2 border-dashed border-slate-300 bg-slate-50 flex flex-col items-center justify-center">
                        <i class="fa-solid fa-map-location-dot text-6xl text-slate-400 mb-5"></i>
                        <h3 class="text-lg font-semibold text-slate-700">
                            Google Maps belum tersedia
                        </h3>
                        <p class="text-slate-500 mt-2">
                            Tambahkan link Google Maps kemudian simpan profil.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- Tombol --}}
    <div class="flex justify-end gap-4 mt-10">
        <a
            href="{{ route('masjid.index') }}"
            class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">
                Batal
        </a>
        <button
            type="submit"
            class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
            <i class="fa-solid fa-floppy-disk"></i>
            {{ $masjid ? 'Perbarui Profil Masjid' : 'Simpan Profil Masjid' }}
        </button>
    </div>
</form>
</div>
@endsection