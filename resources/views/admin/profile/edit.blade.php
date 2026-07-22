@extends('layouts.admin')

@section('content')

<div class="max-w-8xl mx-auto space-y-8">
    {{-- Judul --}}
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Edit Profil Administrator
        </h1>
        <p class="text-slate-500 mt-2">
            Perbarui informasi akun administrator.
        </p>
    </div>
    {{-- Alert --}}
    @if(session('success'))
    <div class="rounded-2xl border border-green-200 bg-green-50 p-4 text-green-700">
        {{ session('success') }}
    </div>
    @endif
    {{-- Form hapus foto (di luar form utama) --}}
    @if($user->foto)
    <form
        id="deletePhotoForm"
        action="{{ route('admin.profile.deletePhoto') }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    @endif
    {{-- Form Update --}}
    <form
        action="{{ route('admin.profile.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-3xl shadow border border-slate-200">
        @csrf
        @method('PATCH')
        <div class="grid lg:grid-cols-3 gap-10 p-10">
            {{-- ================= PANEL KIRI ================= --}}
            <div class="space-y-6">

                <div class="bg-slate-50 rounded-3xl border border-slate-200 p-8">

                    <div class="flex flex-col items-center">
                        {{-- Preview Foto --}}
                        @if($user->foto)
                        <img
                            id="previewImage"
                            src="{{ asset('storage/'.$user->foto) }}"
                            class="w-48 h-48 rounded-full object-cover shadow-lg border-4 border-white">
                        @else
                        <img
                            id="previewImage"
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10b981&color=ffffff&size=300"
                            class="w-48 h-48 rounded-full object-cover shadow-lg border-4 border-white">
                        @endif
                        {{-- Nama --}}
                        <h2 class="mt-6 text-2xl font-bold text-slate-800">
                            {{ $user->name }}
                        </h2>
                        {{-- Role --}}
                        <span
                            class="mt-2 inline-flex items-center px-4 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                            Administrator
                        </span>
                        {{-- Email --}}
                        <p class="text-slate-500 text-sm mt-3">
                            {{ $user->email }}
                        </p>
                        <div>
                            <div class="mt-8 w-full">
                                <label
                                    for="foto"
                                    class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white cursor-pointer transition">
                                    <i class="fa-solid fa-camera"></i>
                                    Ganti Foto Profil
                                </label>
                                <input
                                    id="foto"
                                    type="file"
                                    name="foto"
                                    accept="image/png,image/jpeg,image/jpg"
                                    class="hidden">
                            </div>
                            @if($user->foto)
                            <div class="mt-4">
                                <button
                                    type="button"
                                    onclick="hapusFoto()"
                                    class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white transition">
                                    <i class="fa-solid fa-trash"></i>
                                    Hapus Foto
                                </button>
                            </div>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 text-center mt-4">
                            JPG, JPEG, PNG
                            <br>
                            Maksimal 4 MB
                        </p>
                    </div>
                </div>
            </div>
            {{-- ================= PANEL KANAN ================= --}}
            <div class="lg:col-span-2">
                <div class="bg-slate-50 rounded-3xl border border-slate-200 p-8">
                    <h2 class="text-xl font-bold text-slate-800">
                        Informasi Akun
                    </h2>
                    <p class="text-slate-500 mt-1">
                        Lengkapi informasi administrator.
                    </p>
                    <div class="grid md:grid-cols-2 gap-6 mt-8">
                        {{-- Nama --}}
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name',$user->name) }}"
                                class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-500 focus:border-emerald-500">
                            @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        {{-- Email --}}
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email',$user->email) }}"
                                class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-500 focus:border-emerald-500">
                            @error('email')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        {{-- Nomor HP --}}
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700">
                                Nomor Telepon
                            </label>
                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone',$user->phone) }}"
                                class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        {{-- Role --}}
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700">
                                Role
                            </label>
                            <input
                                type="text"
                                value="{{ ucfirst($user->role) }}"
                                readonly
                                class="w-full rounded-2xl bg-slate-100 border border-slate-300 px-5 py-3">
                        </div>
                    </div>
                    <div class="mt-8">
                        <label class="block mb-2 font-semibold text-slate-700">
                            Alamat
                        </label>
                        <textarea
                            name="address"
                            rows="5"
                            class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-500 focus:border-emerald-500">{{ old('address',$user->address) }}</textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="bg-slate-50 px-10 py-6 flex justify-end gap-4">
            <a
                href="{{ route('admin.profile') }}"
                class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">
                Batal
            </a>
            <button
                class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
<script>
    const foto = document.getElementById('foto');
    const preview = document.getElementById('previewImage');
    foto.addEventListener('change', function() {
        if (this.files.length > 0) {
            preview.src = URL.createObjectURL(this.files[0]);
        }
    });
</script>
<script>
    function hapusFoto() {
        if (confirm('Yakin ingin menghapus foto profil?')) {
            document.getElementById('deletePhotoForm').submit();
        }
    }
</script>
@endsection