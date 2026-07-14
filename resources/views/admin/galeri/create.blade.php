@extends('layouts.admin')

@section('content')

<div class="max-w-8xl mx-auto space-y-8">

    <!-- Header -->
    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Galeri
        </h1>

        <p class="text-slate-500 mt-2">
            Tambahkan dokumentasi kegiatan masjid.
        </p>

    </div>

    <form
        action="{{ route('galeri.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

            <div class="grid md:grid-cols-2 gap-8">

                <!-- Judul -->

                <div>

                    <label class="font-semibold text-slate-700">

                        Judul Foto

                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Contoh : Kajian Ahad Pagi">

                    @error('judul')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Tanggal -->

                <div>

                    <label class="font-semibold text-slate-700">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                    @error('tanggal')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Upload -->

                <div>

                    <label class="font-semibold text-slate-700">

                        Upload Foto

                    </label>

                    <input
                        id="gambar"
                        type="file"
                        name="gambar"
                        accept="image/*"
                        onchange="previewImage(event)"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                    @error('gambar')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Status -->

                <div>

                    <label class="font-semibold text-slate-700">

                        Status

                    </label>

                    <select
                        name="status"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                        <option value="1">

                            Aktif

                        </option>

                        <option value="0">

                            Tidak Aktif

                        </option>

                    </select>

                </div>

            </div>

            <!-- Preview -->

            <div class="mt-8">

                <label class="font-semibold text-slate-700">

                    Preview Foto

                </label>

                <div
                    class="mt-3 border border-dashed border-slate-300 rounded-3xl h-72 flex items-center justify-center bg-slate-50 overflow-hidden">

                    <img
                        id="preview"
                        class="hidden h-full w-full object-cover">

                    <span
                        id="placeholder"
                        class="text-slate-400">

                        Belum ada gambar dipilih

                    </span>

                </div>

            </div>

            <!-- Deskripsi -->

            <div class="mt-8">

                <label class="font-semibold text-slate-700">

                    Deskripsi

                </label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Masukkan deskripsi foto...">{{ old('deskripsi') }}</textarea>

            </div>

            <!-- Button -->

            <div class="flex justify-end gap-4 mt-10">

                <a
                    href="{{ route('galeri.index') }}"
                    class="px-8 py-3 rounded-2xl border border-slate-300 hover:bg-slate-100">

                    Batal

                </a>

                <button
                    class="px-8 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold">

                    Simpan Galeri

                </button>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>
    function previewImage(event) {

        let input = event.target;

        let reader = new FileReader();

        reader.onload = function() {

            document.getElementById('preview').src = reader.result;

            document.getElementById('preview').classList.remove('hidden');

            document.getElementById('placeholder').classList.add('hidden');

        }

        reader.readAsDataURL(input.files[0]);

    }
</script>

@endpush