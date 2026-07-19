@extends('layouts.admin')

@section('content')

<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Manajemen Pengguna
            </h1>
            <p class="text-slate-500 mt-2">
                Kelola seluruh akun Admin dan User pada sistem SIMASJID.
            </p>
        </div>
        <a href="{{ route('users.create') }}"
            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-2xl transition">
            <i class="fa-solid fa-plus"></i>
            Tambah Admin
        </a>
    </div>
    {{-- Statistik --}}
    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Total Admin
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        {{ $totalAdmin }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Total User
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        {{ $totalUser }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        Total Akun
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        {{ $totalAdmin + $totalUser }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-address-book"></i>
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="flex justify-between">
                <div>
                    <p class="text-slate-500">
                        User Aktif
                    </p>
                    <h2 class="mt-3 text-4xl font-bold">
                        {{ $totalOnline }}
                    </h2>
                </div>
                <div class="dashboard-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>
    </div>
    {{-- ============================
        TABEL ADMIN
    ============================= --}}
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-slate-800">
                    Administrator
                </h3>
                <p class="text-slate-500 mt-1">
                    Daftar seluruh akun administrator.
                </p>
            </div>
            <form method="GET" action="{{ route('users.index') }}" class="mb-5">
                <div class="relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        name="admin_search"
                        value="{{ $adminSearch }}"
                        placeholder="Cari Admin..."
                        class="w-full rounded-xl border border-slate-300 pl-11 pr-4 py-3">

                    {{-- mempertahankan pencarian user --}}
                    <input
                        type="hidden"
                        name="user_search"
                        value="{{ $userSearch }}">
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="py-4 text-left">Foto</th>
                        <th class="py-4 text-left">Nama</th>
                        <th class="py-4 text-left">Email</th>
                        <th class="py-4 text-left">No HP</th>
                        <th class="py-4 text-center">Role</th>
                        <th class="py-4 text-left">Login Terakhir</th>
                        <th class="py-4 text-left">Terdaftar</th>
                        <th class="py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                        <td class="py-4">
                            @if($admin->foto)
                            <img src="{{ asset('storage/'.$admin->foto) }}"
                                class="w-12 h-12 rounded-full object-cover">
                            @else
                            <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fa-solid fa-user text-emerald-600"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <h4 class="font-semibold">
                                {{ $admin->name }}
                            </h4>
                        </td>
                        <td>
                            {{ $admin->email }}
                        </td>
                        <td>
                            {{ $admin->phone ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2 justify-center">
                                <span
                                    class="inline-flex w-fit items-center rounded-full bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold">
                                    Administrator
                                </span>
                                @if($admin->online_status == 'online')
                                <span
                                    class="inline-flex items-center gap-2 text-emerald-600 text-xs">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Online
                                </span>
                                @elseif($admin->online_status == 'recent')
                                <span
                                    class="inline-flex items-center gap-2 text-amber-600 text-xs">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Baru saja aktif
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center gap-2 text-slate-500 text-xs">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                    Offline
                                </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($admin->last_login_at)
                            {{ $admin->last_login_at->diffForHumans() }}
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            {{ $admin->created_at->format('d M Y') }}
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('users.show', $admin) }}"
                                    class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600"></i>
                                </a>
                                @if($admin->id != auth()->id())
                                <form action="{{ route('users.destroy',$admin) }}"
                                    method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 text-red-600">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @else
                                <span
                                    class="px-3 py-2 text-xs rounded-xl bg-slate-100 text-slate-500">
                                    Akun Anda
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-slate-500">
                            Belum ada data administrator.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $admins->withQueryString()->links() }}
        </div>
    </div>
    {{-- ============================
        TABEL USER
    ============================= --}}
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-slate-800">
                    User
                </h3>
                <p class="text-slate-500 mt-1">
                    Daftar seluruh akun pengguna SIMASJID.
                </p>
            </div>
            <form method="GET" action="{{ route('users.index') }}" class="mb-5">
                <div class="relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        name="user_search"
                        value="{{ $userSearch }}"
                        placeholder="Cari User..."
                        class="w-full rounded-xl border border-slate-300 pl-11 pr-4 py-3">

                    {{-- mempertahankan pencarian admin --}}
                    <input
                        type="hidden"
                        name="admin_search"
                        value="{{ $adminSearch }}">
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="py-4 text-left">Foto</th>
                        <th class="py-4 text-left">Nama</th>
                        <th class="py-4 text-left">Email</th>
                        <th class="py-4 text-left">No HP</th>
                        <th class="py-4 text-center">Role</th>
                        <th class="py-4 text-left">Login Terakhir</th>
                        <th class="py-4 text-left">Terdaftar</th>
                        <th class="py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                        <td class="py-4">
                            @if($user->foto)
                            <img
                                src="{{ asset('storage/'.$user->foto) }}"
                                class="w-12 h-12 rounded-full object-cover">
                            @else
                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center">
                                <i class="fa-solid fa-user text-slate-500"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <h4 class="font-semibold">
                                {{ $user->name }}
                            </h4>
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->phone ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-2 justify-center">
                                <span
                                    class="inline-flex w-fit items-center rounded-full bg-emerald-100 text-emerald-700 px-3 py-1 text-xs font-semibold">
                                    User
                                </span>
                                @if($user->online_status == 'online')
                                <span
                                    class="inline-flex items-center gap-2 text-emerald-600 text-xs">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Online
                                </span>
                                @elseif($user->online_status == 'recent')
                                <span
                                    class="inline-flex items-center gap-2 text-amber-600 text-xs">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Baru saja aktif
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center gap-2 text-slate-500 text-xs">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                    Offline
                                </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($user->last_login_at)
                            {{ $user->last_login_at->diffForHumans() }}
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Detail --}}
                                <a href="{{ route('users.show', $user) }}"
                                    class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600"></i>
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('users.destroy',$user) }}"
                                    method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 flex items-center justify-center">
                                        <i class="fa-solid fa-trash text-red-600"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-slate-500">
                            Belum ada data user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
@push('scripts')

{{-- ==========================
    SweetAlert Success
========================== --}}

@if(session('success'))

<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session("success") }}',
        confirmButtonColor: '#059669'
    });
</script>

@endif

{{-- ==========================
    SweetAlert Error
========================== --}}

@if(session('error'))

<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session("error") }}',
        confirmButtonColor: '#dc2626'
    });
</script>

@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus Pengguna?',
                    text: 'Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#059669',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: '<i class="fa-solid fa-trash"></i> Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true

                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: .5rem;
    }

    .pagination li {
        list-style: none;
    }

    .pagination li a,
    .pagination li span {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        border: 1px solid #E2E8F0;
        color: #475569;
        transition: .3s;
    }

    .pagination li.active span {
        background: #059669;
        color: white;
        border-color: #059669;
    }

    .pagination li a:hover {
        background: #ECFDF5;
        color: #059669;
        border-color: #10B981;
    }
</style>

@endpush