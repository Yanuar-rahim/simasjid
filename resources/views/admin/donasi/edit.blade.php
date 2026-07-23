@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Verifikasi Donasi

        </h1>

        <p class="text-slate-500 mt-2">

            Periksa data donasi sebelum memberikan status.

        </p>

    </div>

    <form
        action="{{ route('donasi.update',$donasi->id) }}"
        method="POST"
        class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Nama --}}

            <div>

                <label class="font-semibold">

                    Nama Donatur

                </label>

                <input
                    type="text"
                    value="{{ $donasi->nama_donatur }}"
                    readonly
                    class="mt-2 w-full rounded-2xl bg-slate-100 border border-slate-200 px-5 py-3">

            </div>

            {{-- Email --}}

            <div>

                <label class="font-semibold">

                    Email

                </label>

                <input
                    type="text"
                    value="{{ $donasi->email }}"
                    readonly
                    class="mt-2 w-full rounded-2xl bg-slate-100 border border-slate-200 px-5 py-3">

            </div>

            {{-- HP --}}

            <div>

                <label class="font-semibold">

                    Nomor HP

                </label>

                <input
                    type="text"
                    value="{{ $donasi->no_hp }}"
                    readonly
                    class="mt-2 w-full rounded-2xl bg-slate-100 border border-slate-200 px-5 py-3">

            </div>

            {{-- Jenis --}}

            <div>

                <label class="font-semibold">

                    Jenis Donasi

                </label>

                <input
                    type="text"
                    value="{{ $donasi->jenis_donasi }}"
                    readonly
                    class="mt-2 w-full rounded-2xl bg-slate-100 border border-slate-200 px-5 py-3">

            </div>

            {{-- Nominal --}}

            <div>

                <label class="font-semibold">

                    Nominal

                </label>

                <input
                    type="text"
                    value="Rp {{ number_format($donasi->nominal,0,',','.') }}"
                    readonly
                    class="mt-2 w-full rounded-2xl bg-emerald-50 text-emerald-700 font-bold border border-emerald-200 px-5 py-3">

            </div>

            {{-- Metode --}}

            <div>

                <label class="font-semibold">

                    Metode

                </label>

                <input
                    type="text"
                    value="{{ $donasi->metode }}"
                    readonly
                    class="mt-2 w-full rounded-2xl bg-slate-100 border border-slate-200 px-5 py-3">

            </div>

            {{-- Bukti --}}

            <div class="md:col-span-2">

                <label class="font-semibold">

                    Bukti Transfer

                </label>

                <img
                    src="{{ asset('storage/'.$donasi->bukti_transfer) }}"
                    class="mt-3 rounded-2xl border border-slate-200 max-h-[450px]">

            </div>

            {{-- Doa --}}

            <div class="md:col-span-2">

                <label class="font-semibold">

                    Doa / Pesan

                </label>

                <textarea
                    readonly
                    rows="5"
                    class="mt-2 w-full rounded-2xl bg-slate-100 border border-slate-200 px-5 py-3">{{ $donasi->doa }}</textarea>

            </div>

            {{-- Status --}}

            <div>

                <label class="font-semibold">

                    Status Verifikasi

                </label>

                <select
                    name="status"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">

                    <option value="Menunggu"
                        {{ $donasi->status=='Menunggu'?'selected':'' }}>

                        Menunggu

                    </option>

                    <option value="Diterima"
                        {{ $donasi->status=='Diterima'?'selected':'' }}>
                        Diterima
                    </option>
                    <option value="Ditolak"
                        {{ $donasi->status=='Ditolak'?'selected':'' }}>
                        Ditolak
                    </option>
                </select>
            </div>
            {{-- Catatan --}}
            <div class="md:col-span-2">
                <label class="font-semibold">
                    Catatan Admin
                </label>
                <textarea
                    name="catatan_admin"
                    rows="5"
                    class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3">{{ old('catatan_admin',$donasi->catatan_admin) }}</textarea>
            </div>
        </div>
        <div class="flex justify-end gap-4 mt-10">
            <a
                href="{{ route('donasi.show',$donasi->id) }}"
                class="px-6 py-3 rounded-2xl border border-slate-300">
                Batal
            </a>
            <button
                class="px-7 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white">
                <i class="fa-solid fa-circle-check mr-2"></i>
                Simpan Verifikasi
            </button>
        </div>
    </form>
</div>

@endsection