@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Pengeluaran
        </h1>
        <p class="text-slate-500 mt-2">
            Tambahkan data pengeluaran kas masjid.
        </p>
    </div>

    <form action="{{ route('pengeluaran.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            <!-- Header Card -->
            <div class="px-8 py-6 border-b border-slate-200">
                <h2 class="text-xl font-bold text-slate-800">
                    Form Data Pengeluaran
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Lengkapi seluruh informasi pengeluaran kas masjid.
                </p>
            </div>

            <!-- Body -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Kategori -->

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Kategori Pengeluaran
                        </label>
                        <select
                            name="kategori"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                            focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="">Pilih Kategori</option>
                            <option>Operasional</option>
                            <option>Pembangunan</option>
                            <option>Perawatan</option>
                            <option>Honorarium</option>
                            <option>Kegiatan</option>
                            <option>Sosial</option>
                            <option>Lainnya</option>
                        </select>
                    </div>

                    <!-- Nominal -->

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nominal
                        </label>
                        <input
                            type="number"
                            name="nominal"
                            placeholder="Contoh : 500000"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                            focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <!-- Tanggal -->

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tanggal Pengeluaran
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ date('Y-m-d') }}"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                            focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <!-- Bukti -->

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            name="bukti"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                            focus:border-emerald-500 focus:ring-emerald-500">
                        <small class="text-slate-500">
                            JPG, PNG atau PDF (maks 2 MB)
                        </small>
                    </div>
                </div>

                <!-- Keterangan -->

                <div class="mt-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Keterangan
                    </label>
                    <textarea
                        name="keterangan"
                        rows="6"
                        placeholder="Tuliskan keterangan pengeluaran..."
                        class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                        focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                </div>

            </div>

            <!-- Footer -->

            <div class="px-8 py-6 border-t border-slate-200 bg-slate-50 flex justify-end gap-3">
                <a
                    href="{{ route('keuangan.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-100 transition">
                    Batal
                </a>
                <button
                    class="px-8 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow">
                    Simpan Pengeluaran
                </button>
            </div>
        </div>
    </form>
</div>

@endsection