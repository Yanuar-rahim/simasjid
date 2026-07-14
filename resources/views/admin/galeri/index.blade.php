@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Galeri Masjid
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola dokumentasi kegiatan masjid.
            </p>

        </div>

        <a href="{{ route('galeri.create') }}"
            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl">

            <i class="fa-solid fa-plus"></i>

            Tambah Foto

        </a>

    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200">

        <div class="p-6 border-b border-slate-200">

            <form method="GET">

                <div class="flex gap-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari judul foto..."
                        class="w-full rounded-2xl border border-slate-300 px-5 py-3">

                    <button
                        class="px-6 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-700">

                        Cari

                    </button>

                </div>

            </form>

        </div>

        <div class="p-8">

            <div class="grid lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @forelse($galeri as $item)

                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow hover:shadow-xl duration-300">

                    <img
                        src="{{ asset('storage/'.$item->gambar) }}"
                        class="w-full h-60 object-cover">

                    <div class="p-5">

                        <h3 class="font-bold text-lg">

                            {{ $item->judul }}

                        </h3>

                        <p class="text-slate-500 mt-2 text-sm">

                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                        </p>

                        @if($item->deskripsi)

                        <p class="text-slate-500 mt-4 text-sm">

                            {{ Str::limit($item->deskripsi,60) }}

                        </p>

                        @endif

                        <div class="flex justify-between items-center mt-6">

                            @if($item->status)

                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs">

                                Aktif

                            </span>

                            @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs">

                                Tidak Aktif

                            </span>

                            @endif

                            <div class="flex gap-2">

                                <a
                                    href="{{ route('galeri.show',$item) }}"
                                    class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 hover:bg-blue-100">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <a
                                    href="{{ route('galeri.edit',$item) }}"
                                    class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 hover:bg-emerald-100">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form
                                    action="{{ route('galeri.destroy',$item) }}"
                                    method="POST"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 hover:bg-red-100">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

                @empty

                <div class="col-span-full text-center py-20">

                    <i class="fa-solid fa-images text-6xl text-slate-300"></i>

                    <h3 class="text-2xl font-bold mt-5">

                        Belum Ada Galeri

                    </h3>

                    <p class="text-slate-500 mt-2">

                        Silakan tambahkan dokumentasi kegiatan.

                    </p>

                </div>

                @endforelse

            </div>

            @if($galeri->hasPages())

            <div class="mt-10">

                {{ $galeri->links() }}

            </div>

            @endif

        </div>

    </div>

</div>

@endsection

@push('scripts')

@if(session('success'))

<script>
    Swal.fire({

        icon: 'success',

        title: 'Berhasil',

        text: '{{ session("success") }}',

        timer: 2000,

        showConfirmButton: false,

        toast: true,

        position: 'top-end'

    });
</script>

@endif

<script>
    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({

                title: 'Hapus Foto?',

                text: 'Foto akan dihapus permanen.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Hapus',

                cancelButtonText: 'Batal',

                confirmButtonColor: '#dc2626'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });
</script>

@endpush