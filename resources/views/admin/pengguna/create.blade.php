@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Admin
            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan administrator baru ke dalam sistem.
            </p>
        </div>
        <a href="{{ route('users.index') }}"
            class="px-5 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>
    {{-- Form --}}
    <div class="dashboard-card">
        <form
            action="{{ route('users.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-8">
                {{-- ========================= --}}
                {{-- FOTO --}}
                {{-- ========================= --}}
                <div class="bg-slate-50 rounded-3xl border-2 border-dashed border-slate-300 p-8">
                    <label class="font-semibold text-slate-700 block mb-6">
                        Foto Profil
                    </label>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-44 h-44 rounded-full overflow-hidden border-4 border-white shadow-lg bg-slate-200">
                            <img
                                id="preview"
                                src="https://placehold.co/250x250?text=Foto"
                                class="w-full h-full object-cover">
                        </div>
                        <label
                            for="foto"
                            class="mt-6 cursor-pointer px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white transition">
                            <i class="fa-solid fa-upload mr-2"></i>
                            Pilih Foto
                        </label>
                        <input
                            id="foto"
                            name="foto"
                            type="file"
                            accept="image/*"
                            class="hidden">
                        <small class="text-slate-500 mt-3">
                            JPG, PNG • Maksimal 4 MB
                        </small>
                    </div>
                </div>
                {{-- ========================= --}}
                {{-- DATA --}}
                {{-- ========================= --}}
                <div class="space-y-6">
                    {{-- Nama --}}
                    <div>
                        <label class="font-semibold block mb-2">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition">
                        @error('name')
                        <small class="text-red-500">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- Email --}}
                    <div>
                        <label class="font-semibold block mb-2">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition">
                        @error('email')
                        <small class="text-red-500">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- HP --}}
                    <div>
                        <label class="font-semibold block mb-2">
                            Nomor HP
                        </label>
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition">
                    </div>
                    {{-- Alamat --}}
                    <div>
                        <label class="font-semibold block mb-2">
                            Alamat
                        </label>
                        <textarea
                            name="address"
                            rows="3"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition">{{ old('address') }}</textarea>
                    </div>
                    {{-- Password --}}
                    <div>
                        <label class="font-semibold block mb-2">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition">
                        @error('password')
                        <small class="text-red-500">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="font-semibold block mb-2">
                            Konfirmasi Password
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition">
                    </div>
                </div>
            </div>

            {{-- Button --}}

            <div class="flex justify-end gap-4 mt-10">
                <a
                    href="{{ route('users.index') }}"
                    class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">
                    Batal
                </a>
                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')

<script>
    document.getElementById('foto').addEventListener('change', function() {
        if (!this.files.length) return;
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.classList.remove('object-contain');
            preview.classList.add('object-cover');
        }
        reader.readAsDataURL(file);
    });
</script>

@endpush