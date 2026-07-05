@extends('layouts.admin')

@section('content')

<div class="max-w-l mx-auto">

    <!-- Header -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Pengumuman
        </h1>

        <p class="text-slate-500 mt-1">
            Tambahkan pengumuman terbaru untuk jamaah.
        </p>

    </div>

    <form
        action="{{ route('pengumuman.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

        @csrf

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Judul -->

            <div class="md:col-span-2">

                <label class="font-semibold">
                    Judul Pengumuman
                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                @error('judul')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Banner -->

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
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Preview -->

            <div>

                <label class="font-semibold">

                    Preview Banner

                </label>

                <div class="mt-2 h-44 rounded-2xl border border-dashed border-slate-300 flex items-center justify-center overflow-hidden">

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

            <!-- Kategori -->

            <div>

                <label class="font-semibold">

                    Kategori

                </label>

                <input
                    type="text"
                    name="kategori"
                    value="{{ old('kategori') }}"
                    placeholder="Contoh : Informasi"

                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                @error('kategori')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

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

            <!-- Isi -->

            <div class="md:col-span-2">

                <label class="font-semibold">

                    Isi Pengumuman

                </label>

                <textarea
                    rows="8"
                    name="isi"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">{{ old('isi') }}</textarea>

                @error('isi')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

        </div>

        <div class="flex justify-end gap-4 mt-10">

            <a
                href="{{ route('pengumuman.index') }}"
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
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

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