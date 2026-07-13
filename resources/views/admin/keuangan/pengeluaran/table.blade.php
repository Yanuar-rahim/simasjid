<div class="space-y-6">

    <!-- Header -->

    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold">
                Data Pengeluaran
            </h3>
            <p class="text-slate-500 mt-1">
                Seluruh transaksi pengeluaran kas masjid.
            </p>
        </div>

        <a href="{{ route('pengeluaran.create') }}"
            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl">
            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Pengeluaran
        </a>
        
    </div>

    <!-- Table -->

    <div class="overflow-x-auto rounded-3xl border border-slate-200">
        <table class="min-w-full">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">
                        No
                    </th>
                    <th class="px-6 py-4 text-left">
                        Kategori
                    </th>
                    <th class="px-6 py-4 text-left">
                        Petugas
                    </th>
                    <th class="px-6 py-4 text-right">
                        Nominal
                    </th>
                    <th class="px-6 py-4 text-center">
                        Tanggal
                    </th>
                    <th class="px-6 py-4 text-center">
                        Bukti
                    </th>
                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse($pengeluaran as $item)

                <tr class="hover:bg-slate-50 border-b">
                    <td class="px-6 py-5">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-5">
                        <div class="font-semibold">
                            {{ $item->kategori }}
                        </div>

                        @if($item->keterangan)

                        <div class="text-sm text-slate-500 mt-1">
                            {{ \Illuminate\Support\Str::limit($item->keterangan,50) }}
                        </div>

                        @endif
                    </td>

                    <td class="px-6 py-5">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    <td class="px-6 py-5 text-right">
                        <span class="font-bold text-red-600">
                            Rp {{ number_format($item->nominal,0,',','.') }}
                        </span>
                    </td>

                    <td class="px-6 py-5 text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                    </td>

                    <td class="px-6 py-5 text-center">

                        @if($item->bukti)

                        <a href="{{ asset('storage/'.$item->bukti) }}"
                            target="_blank"
                            class="text-blue-600 hover:underline">
                            Lihat
                        </a>

                        @else

                        <span class="text-slate-400">
                            -
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-5">
                        <div class="flex justify-center gap-2">

                            <a
                                href="{{ route('pengeluaran.show',$item->id) }}"
                                class="w-10 h-10 rounded-xl bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a
                                href="{{ route('pengeluaran.edit',$item->id) }}"
                                class="w-10 h-10 rounded-xl bg-yellow-50 hover:bg-yellow-100 flex items-center justify-center text-yellow-600">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form
                                action="{{ route('pengeluaran.destroy',$item->id) }}"
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
                    <td colspan="7"
                        class="text-center py-20">
                        <i class="fa-solid fa-file-invoice-dollar text-5xl text-slate-300"></i>
                        <p class="mt-5 text-xl font-semibold text-slate-500">
                            Belum ada data pengeluaran
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>