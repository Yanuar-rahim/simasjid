@extends('layouts.admin')

@section('content')

<div class="max-w-l mx-auto">

    <!-- Header -->

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Edit Pengumuman
        </h1>

        <p class="text-slate-500 mt-1">
            Perbarui informasi pengumuman masjid.
        </p>

    </div>

    <form
        action="{{ route('pengumuman.update',$pengumuman->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Judul -->

            <div class="md:col-span-2">

                <label class="font-semibold">
                    Judul Pengumuman
                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul',$pengumuman->judul) }}"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">

                @error('judul')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

                @enderror

            </div>

            <!-- Upload Banner -->

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

                    Preview Banner

                </label>

                <div class="mt-2 h-44 rounded-2xl border border-dashed border-slate-300 flex items-center justify-center overflow-hidden">

                    @if($pengumuman->gambar)

                    <img
                        id="preview"
                        src="{{ asset('storage/'.$pengumuman->gambar) }}"
                        class="w-full h-full object-cover">

                    <span
                        id="placeholder"
                        class="hidden">

                    </span>

                    @else

                    <img
                        id="preview"
                        class="hidden w-full h-full object-cover">

                    <span
                        id="placeholder"
                        class="text-slate-400">

                        Belum ada gambar

                    </span>

                    @endif

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
                    value="{{ old('kategori',$pengumuman->kategori) }}"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                @error('kategori')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

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

                    <option
                        value="Aktif"
                        {{ $pengumuman->status=='Aktif'?'selected':'' }}>

                        Aktif

                    </option>

                    <option
                        value="Draft"
                        {{ $pengumuman->status=='Draft'?'selected':'' }}>

                        Draft

                    </option>

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
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">{{ old('isi',$pengumuman->isi) }}</textarea>

                @error('isi')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

                @enderror

            </div>

        </div>

        <!-- Tombol -->

        <div class="flex justify-end gap-4 mt-10">

            <a
                href="{{ route('pengumuman.index') }}"
                class="px-6 py-3 rounded-2xl border border-slate-300 hover:bg-slate-100">

                Batal

            </a>

            <button
                type="submit"
                class="px-7 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white transition">

                <i class="fa-solid fa-floppy-disk mr-2"></i>

                Update Pengumuman

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

    gambar.addEventListener('change', function() {

        const file = this.files[0];

        if (file) {

            preview.src = URL.createObjectURL(file);

            preview.classList.remove('hidden');

            placeholder.classList.add('hidden');

        }

    });
</script>

@endpush