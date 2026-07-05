@extends('layouts.admin')

@section('content')

<div class="max-w-l mx-auto">

    <!-- Header -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Kegiatan
        </h1>

        <p class="text-slate-500 mt-1">
            Tambahkan informasi kegiatan masjid.
        </p>

    </div>

    <form
        action="{{ route('kegiatan.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

        @csrf

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Judul -->

            <div class="md:col-span-2">

                <label class="font-semibold">
                    Judul Kegiatan
                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">

                @error('judul')

                <p class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </p>

                @enderror

            </div>

            <!-- Gambar -->

            <div>

                <label class="font-semibold">

                    Banner

                </label>

                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    class="mt-2 w-full rounded-xl border border-slate-300 p-3">

                @error('gambar')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

                @enderror

            </div>

            <!-- Preview -->

            <div>

                <label class="font-semibold">

                    Preview

                </label>

                <div
                    class="mt-2 h-44 rounded-2xl border border-dashed border-slate-300 flex items-center justify-center overflow-hidden">

                    <img
                        id="preview"
                        class="hidden w-full h-full object-cover">

                    <span
                        id="placeholder"
                        class="text-slate-400">

                        Belum ada gambar

                    </span>

                </div>

            </div>

            <!-- Tanggal -->

            <div>

                <label class="font-semibold">

                    Tanggal

                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

            </div>

            <!-- Jam -->

            <div>

                <label class="font-semibold">

                    Jam

                </label>

                <input
                    type="time"
                    name="jam"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

            </div>

            <!-- Lokasi -->

            <div>

                <label class="font-semibold">

                    Lokasi

                </label>

                <input
                    type="text"
                    name="lokasi"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

            </div>

            <!-- Pemateri -->

            <div>

                <label class="font-semibold">

                    Pemateri

                </label>

                <input
                    type="text"
                    name="pemateri"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

            </div>

            <!-- Status -->

            <div>

                <label class="font-semibold">

                    Status

                </label>

                <select
                    name="status"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                    <option value="Aktif">Aktif</option>

                    <option value="Draft">Draft</option>

                </select>

            </div>

            <!-- Deskripsi -->

            <div class="md:col-span-2">

                <label class="font-semibold">

                    Deskripsi

                </label>

                <textarea
                    rows="8"
                    name="deskripsi"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3"></textarea>

            </div>

        </div>

        <div class="flex justify-end gap-4 mt-10">

            <a
                href="{{ route('kegiatan.index') }}"
                class="px-6 py-3 rounded-2xl border">

                Batal

            </a>

            <button
                class="px-7 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white transition">

                Simpan

            </button>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script>
    const gambar = document.getElementById('gambar');

    gambar.onchange = function() {

        const file = this.files[0];

        if (file) {

            preview.src = URL.createObjectURL(file);

            preview.classList.remove('hidden');

            placeholder.classList.add('hidden');

        }

    }
</script>

@endpush