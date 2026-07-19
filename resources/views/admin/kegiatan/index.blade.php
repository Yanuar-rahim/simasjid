@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Manajemen Kegiatan
            </h1>
            <p class="text-slate-500 mt-1">
                Kelola seluruh kegiatan masjid.
            </p>
        </div>
        <a href="{{ route('kegiatan.create') }}"
            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-xl transition">
            <i class="fa-solid fa-plus"></i>
            Tambah Kegiatan
        </a>
    </div>
    <!-- Filter -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
        <form method="GET" action="{{ route('kegiatan.index') }}"
            class="flex flex-col lg:flex-row gap-4 justify-between">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kegiatan..."
                class="rounded-xl border border-slate-300 px-4 py-3 w-full lg:w-80">
            <div>
                <select
                    name="status"
                    class="rounded-xl border border-slate-300 px-4 py-3 w-full lg:w-56">
                    <option value="">Semua Status</option>
                    <option value="Aktif"
                        {{ request('status')=='Aktif'?'selected':'' }}>
                        Aktif
                    </option>
                    <option value="Draft"
                        {{ request('status')=='Draft'?'selected':'' }}>
                        Draft
                    </option>
                </select>
                <button
                    class="bg-emerald-600 text-white py-3 px-5 rounded-xl">
                    Cari
                </button>
            </div>
        </form>
    </div>
    @if(session('success'))
    <div class="rounded-xl bg-green-50 border border-green-200 text-green-700 p-4">
        <i class="fa-solid fa-circle-check mr-2"></i>
        {{ session('success') }}
    </div>
    @endif
    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-emerald-600">
                <tr class="text-left text-white">
                    <th class="p-5">Gambar</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $item)
                <tr class="hover:bg-slate-50 transition text-slate-500">
                    <td class="p-4">
                        @if($item->gambar)
                        <img
                            src="{{ asset('storage/'.$item->gambar) }}"
                            class="w-24 h-16 rounded-xl object-cover">
                        @else
                        <div class="w-24 h-16 rounded-xl bg-slate-100 flex items-center justify-center">
                            <i class="fa-solid fa-image text-slate-400"></i>
                        </div>
                        @endif
                    </td>
                    <td>
                        <h3 class="font-semibold">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-xs text-slate-500">
                            {{ $item->pemateri }}
                        </p>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        <br>
                        <small class="text-slate-500">
                            {{ $item->jam }}
                        </small>
                    </td>
                    <td>
                        {{ $item->lokasi }}
                    </td>
                    <td>
                        @if($item->status=='Aktif')
                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                            Aktif
                        </span>
                        @else
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                            Draft
                        </span>
                        @endif
                    </td>
                    <td>
                        <div class="flex justify-center gap-3">
                            <a
                                href="{{ route('kegiatan.show',$item->id) }}"
                                class="w-10 h-10 rounded-xl bg-emerald-50 hover:bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a
                                href="{{ route('kegiatan.edit',$item->id) }}"
                                class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('kegiatan.destroy',$item->id) }}"
                                method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">
                        <i class="fa-solid fa-calendar-days text-5xl text-slate-300"></i>
                        <h3 class="mt-5 text-xl font-semibold">
                            Belum Ada Kegiatan
                        </h3>
                        <p class="text-slate-500 mt-2">
                            Data kegiatan akan muncul di sini.
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $kegiatan->links() }}
    </div>
</div>

@endsection

@push('scripts')

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus kegiatan?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endpush