@extends('layouts.admin')

@section('content')

<div class="max-w-l mx-auto space-y-8">

    <!-- Header -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Kegiatan
            </h1>

            <p class="text-slate-500 mt-1">
                Perbarui informasi kegiatan masjid.
            </p>

        </div>

        <a href="{{ route('kegiatan.index') }}"
            class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <!-- Form -->

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

        <form
            action="{{ route('kegiatan.update',$kegiatan->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Judul -->

            <div>

                <label class="block font-semibold mb-2">
                    Judul Kegiatan
                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul',$kegiatan->judul) }}"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500">

                @error('judul')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Gambar -->

            <div>

                <label class="block font-semibold mb-3">
                    Gambar Kegiatan
                </label>

                @if($kegiatan->gambar)

                <img
                    src="{{ asset('storage/'.$kegiatan->gambar) }}"
                    class="w-60 rounded-xl border mb-4">

                @endif

                <input
                    type="file"
                    name="gambar"
                    class="w-full rounded-xl border border-slate-300 p-3">

                <p class="text-sm text-slate-500 mt-2">
                    Kosongkan jika tidak ingin mengganti gambar.
                </p>

                @error('gambar')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Tanggal & Jam -->

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block font-semibold mb-2">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal',$kegiatan->tanggal) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('tanggal')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Jam
                    </label>

                    <input
                        type="time"
                        name="jam"
                        value="{{ old('jam',$kegiatan->jam) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('jam')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <!-- Lokasi -->

            <div>

                <label class="block font-semibold mb-2">
                    Lokasi
                </label>

                <input
                    type="text"
                    name="lokasi"
                    value="{{ old('lokasi',$kegiatan->lokasi) }}"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3">

                @error('lokasi')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Pemateri -->

            <div>

                <label class="block font-semibold mb-2">
                    Pemateri
                </label>

                <input
                    type="text"
                    name="pemateri"
                    value="{{ old('pemateri',$kegiatan->pemateri) }}"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3">

                @error('pemateri')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Status -->

            <div>

                <label class="block font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    <option value="Aktif"
                        {{ old('status',$kegiatan->status)=='Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="Draft"
                        {{ old('status',$kegiatan->status)=='Draft' ? 'selected' : '' }}>
                        Draft
                    </option>

                </select>

            </div>

            <!-- Deskripsi -->

            <div>

                <label class="block font-semibold mb-2">
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    rows="6"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3">{{ old('deskripsi',$kegiatan->deskripsi) }}</textarea>

                @error('deskripsi')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Button -->

            <div class="flex justify-end gap-3 pt-4">

                <a
                    href="{{ route('kegiatan.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection