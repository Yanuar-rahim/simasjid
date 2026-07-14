@extends('layouts.admin')

@section('content')

<div class="max-w-8xl mx-auto space-y-8">

    <!-- Header -->

    <div>

        <h1 class="text-3xl font-bold text-slate-800">

            Edit Galeri

        </h1>

        <p class="text-slate-500 mt-2">

            Perbarui dokumentasi kegiatan masjid.

        </p>

    </div>

    <form
        action="{{ route('galeri.update',$galeri) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

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
                        value="{{ old('judul',$galeri->judul) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                    @error('judul')

                    <small class="text-red-500">

                        {{ $message }}

                    </small>

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
                        value="{{ old('tanggal',$galeri->tanggal->format('Y-m-d')) }}"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                </div>

                <!-- Upload -->

                <div>

                    <label class="font-semibold text-slate-700">

                        Ganti Foto

                    </label>

                    <input
                        type="file"
                        name="gambar"
                        accept="image/*"
                        onchange="previewImage(event)"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                </div>

                <!-- Status -->

                <div>

                    <label class="font-semibold text-slate-700">

                        Status

                    </label>

                    <select
                        name="status"
                        class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                        <option
                            value="1"
                            {{ $galeri->status ? 'selected' : '' }}>

                            Aktif

                        </option>

                        <option
                            value="0"
                            {{ !$galeri->status ? 'selected' : '' }}>

                            Tidak Aktif

                        </option>

                    </select>

                </div>

            </div>

            <!-- Preview -->

            <div class="mt-8">

                <label class="font-semibold text-slate-700">

                    Foto Saat Ini

                </label>

                <div
                    class="mt-3 rounded-3xl overflow-hidden border border-slate-300">

                    <img
                        id="preview"
                        src="{{ asset('storage/'.$galeri->gambar) }}"
                        class="w-full h-96 object-cover">

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
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">{{ old('deskripsi',$galeri->deskripsi) }}</textarea>

            </div>

            <!-- Button -->

            <div class="flex justify-end gap-4 mt-10">

                <a
                    href="{{ route('galeri.index') }}"
                    class="px-8 py-3 rounded-2xl border border-slate-300">

                    Batal

                </a>

                <button
                    class="px-8 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white">

                    Update Galeri

                </button>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>
    function previewImage(event) {

        let reader = new FileReader();

        reader.onload = function() {

            document.getElementById('preview').src = reader.result;

        }

        reader.readAsDataURL(event.target.files[0]);

    }
</script>

@endpush