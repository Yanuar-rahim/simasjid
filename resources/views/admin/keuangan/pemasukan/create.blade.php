@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Tambah Data Pemasukan
                </h1>
                <p class="text-slate-500 mt-1">
                    Tambahkan transaksi pemasukan kas masjid.
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('pemasukan.store') }}" method="POST">

        @csrf

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Header --}}
            <div class="px-8 py-6 border-b border-slate-200">
                <h2 class="text-xl font-bold text-slate-800">
                    Form Data Pemasukan
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Lengkapi seluruh informasi pemasukan kas masjid.
                </p>
            </div>

            {{-- Body --}}
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Donasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Donasi (Opsional)
                        </label>

                        <select
                            id="donasiSelect"
                            name="donasi_id"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                    focus:border-emerald-500 focus:ring-emerald-500">

                            <option value="">
                                Input Manual
                            </option>

                            @forelse($donasi as $item)

                            <option
                                value="{{ $item->id }}"
                                data-nominal="{{ $item->nominal }}"
                                data-sumber="Donasi Online">

                                #{{ $item->id }}
                                -
                                {{ $item->nama }}
                                -
                                Rp {{ number_format($item->nominal,0,',','.') }}

                            </option>

                            @empty

                            <option disabled>

                                Tidak ada donasi yang belum dicatat

                            </option>

                            @endforelse

                        </select>

                    </div>

                    {{-- Sumber --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Sumber Pemasukan
                        </label>

                        <input
                            id="sumber"
                            type="text"
                            name="sumber"
                            placeholder="Contoh : Donasi Jumat"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                    focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    {{-- Nominal --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nominal
                        </label>

                        <input
                            id="nominal"
                            type="number"
                            name="nominal"
                            placeholder="100000"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                    focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Tanggal
                        </label>
                        <input
                            type="date"
                            name="tanggal"
                            value="{{ date('Y-m-d') }}"
                            class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                    focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                </div>

                {{-- Keterangan --}}
                <div class="mt-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Keterangan
                    </label>
                    <textarea
                        name="keterangan"
                        rows="6"
                        placeholder="Tuliskan keterangan pemasukan..."
                        class="w-full rounded-xl border border-slate-300 shadow-sm px-4 py-3
                focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-6 border-t border-slate-200 bg-slate-50 flex justify-end gap-3">
                <a
                    href="{{ route('keuangan.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-100 transition">
                    Batal
                </a>
                <button
                    class="px-8 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow">
                    Simpan Data
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const select = document.getElementById('donasiSelect');
        const nominal = document.getElementById('nominal');
        const sumber = document.getElementById('sumber');

        select.addEventListener('change', function() {
            if (this.value != '') {
                let option = this.options[this.selectedIndex];

                nominal.value = option.dataset.nominal;
                sumber.value = option.dataset.sumber;

                nominal.readOnly = true;
                nominal.classList.add('bg-slate-100');
            } else {
                nominal.value = '';
                sumber.value = '';

                nominal.readOnly = false;
                nominal.classList.remove('bg-slate-100');
            }
        });
    });
</script>

@endpush

@endsection