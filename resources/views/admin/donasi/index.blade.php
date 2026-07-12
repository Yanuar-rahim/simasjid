@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Donasi Masuk
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola dan verifikasi seluruh transaksi donasi jamaah.
            </p>

        </div>

    </div>

    <!-- Statistik -->

    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">

        <div class="dashboard-card">

            <p class="text-slate-500">

                Total Donasi

            </p>

            <h2 class="text-3xl font-bold text-emerald-600 mt-3">

                Rp {{ number_format($totalNominal,0,',','.') }}

            </h2>

            <p class="text-sm text-slate-400 mt-2">

                Donasi berhasil diterima

            </p>

        </div>

        <div class="dashboard-card">

            <p class="text-slate-500">

                Menunggu

            </p>

            <h2 class="text-3xl font-bold text-yellow-500 mt-3">

                {{ $totalMenunggu }}

            </h2>

            <p class="text-sm text-slate-400 mt-2">

                Menunggu verifikasi

            </p>

        </div>

        <div class="dashboard-card">

            <p class="text-slate-500">

                Diterima

            </p>

            <h2 class="text-3xl font-bold text-emerald-600 mt-3">

                {{ $totalDiterima }}

            </h2>

            <p class="text-sm text-slate-400 mt-2">

                Sudah diverifikasi

            </p>

        </div>

        <div class="dashboard-card">

            <p class="text-slate-500">

                Ditolak

            </p>

            <h2 class="text-3xl font-bold text-red-500 mt-3">

                {{ $totalDitolak }}

            </h2>

            <p class="text-sm text-slate-400 mt-2">

                Donasi ditolak

            </p>

        </div>

    </div>

    <!-- Card -->

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- Filter -->

        <div class="p-6 border-b border-slate-200">

            <form method="GET" class="flex flex-col lg:flex-row gap-4 justify-between">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau email donatur..."
                    class="h-12 rounded-2xl border border-slate-300 px-5 w-full lg:w-80">

                <div class="flex gap-3">

                    <select
                        name="status"
                        class="h-12 rounded-2xl border border-slate-300 px-5">

                        <option value="">Semua Status</option>

                        <option value="Menunggu"
                            @selected(request('status')=='Menunggu' )>
                            Menunggu
                        </option>

                        <option value="Diterima"
                            @selected(request('status')=='Diterima' )>
                            Diterima
                        </option>

                        <option value="Ditolak"
                            @selected(request('status')=='Ditolak' )>
                            Ditolak
                        </option>

                    </select>

                    <button
                        type="submit"
                        class="h-12 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium transition flex items-center justify-center">

                        <i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Cari

                    </button>

                </div>

            </form>

        </div>

        <!-- Table -->

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-emerald-600 text-white text-sm font-semibold">

                    <tr>

                        <th class="px-6 py-4 text-left">

                            Donatur

                        </th>

                        <th class="px-6 py-4 text-left">

                            Jenis

                        </th>

                        <th class="px-6 py-4 text-left">

                            Nominal

                        </th>

                        <th class="px-6 py-4 text-left">

                            Metode

                        </th>

                        <th class="px-6 py-4 text-left">

                            Status

                        </th>

                        <th class="px-6 py-4 text-left">

                            Tanggal

                        </th>

                        <th class="px-6 py-4 text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($donasi as $item)

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-5">

                            <div>

                                <h4 class="font-semibold">

                                    {{ $item->nama_donatur }}

                                </h4>

                                <p class="text-sm text-slate-500">

                                    {{ $item->email }}

                                </p>

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            {{ $item->jenis_donasi }}

                        </td>

                        <td class="px-6 py-5 font-bold text-emerald-600">

                            Rp {{ number_format($item->nominal,0,',','.') }}

                        </td>

                        <td class="px-6 py-5">

                            {{ $item->metode }}

                        </td>

                        <td class="px-6 py-5">

                            @if($item->status=='Menunggu')

                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                                Menunggu

                            </span>

                            @elseif($item->status=='Diterima')

                            <span class="px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-sm">

                                Diterima

                            </span>

                            @else

                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm">

                                Ditolak

                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-5">

                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('donasi.show',$item->id) }}"
                                    class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <!-- <a
                                    href="{{ route('donasi.edit',$item->id) }}"
                                    class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100">

                                    <i class="fa-solid fa-circle-check"></i>

                                </a> -->

                                <form
                                    action="{{ route('donasi.destroy',$item->id) }}"
                                    method="POST"
                                    class="form-delete">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-600 hover:bg-red-100">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="7"
                            class="py-16 text-center">

                            <i class="fa-solid fa-hand-holding-heart text-5xl text-slate-300"></i>

                            <h3 class="mt-5 text-xl font-semibold">

                                Belum Ada Donasi

                            </h3>

                            <p class="text-slate-500 mt-2">

                                Data donasi akan muncul di sini.

                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->

        @if($donasi->hasPages())

        <div class="p-6 border-t">

            {{ $donasi->links() }}

        </div>

        @endif

    </div>

</div>

@push('scripts')

@if(session('success'))

<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        timer: 2200,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
</script>

@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const forms = document.querySelectorAll('.form-delete');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus Donasi?',
                    text: 'Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true

                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,

                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endpush

@endsection