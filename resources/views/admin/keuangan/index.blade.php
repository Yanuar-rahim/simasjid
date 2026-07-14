@extends('layouts.admin')

@section('content')

<div
    x-data="{tab:'pemasukan'}"
    class="space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">
                Transparansi Keuangan
            </h1>
            <p class="text-slate-500 mt-2">
                Kelola seluruh pemasukan dan pengeluaran kas masjid.
            </p>
        </div>
    </div>

    <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6">
        <div class="dashboard-card">
            <p class="text-slate-500">
                Saldo Kas
            </p>
            <h2 class="mt-3 text-3xl font-bold text-blue-600">
                Rp {{ number_format($saldoKas,0,',','.') }}
            </h2>
        </div>

        <div class="dashboard-card">
            <p class="text-slate-500">
                Total Pemasukan
            </p>
            <h2 class="mt-3 text-3xl font-bold text-emerald-600">
                Rp {{ number_format($totalPemasukan,0,',','.') }}
            </h2>
        </div>

        <div class="dashboard-card">
            <p class="text-slate-500">
                Total Pengeluaran
            </p>
            <h2 class="mt-3 text-3xl font-bold text-red-600">
                Rp {{ number_format($totalPengeluaran,0,',','.') }}
            </h2>
        </div>

        <div class="dashboard-card">
            <p class="text-slate-500">
                Total Transaksi
            </p>
            <h2 class="mt-3 text-3xl font-bold">
                {{ $pemasukan->count()+$pengeluaran->count() }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="flex justify-between">
            <div>
                <h3 class="text-xl font-semibold">
                    Grafik Keuangan
                </h3>
                <p class="text-slate-500">
                    Perbandingan pemasukan dan pengeluaran
                </p>
            </div>
        </div>
        <div class="mt-8 h-96">
            <canvas id="chartKeuangan"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm">
        <div class="flex">
            <button
                @click="tab='pemasukan'"
                :class="tab=='pemasukan'
            ? 'border-b-4 border-emerald-600 text-emerald-600'
            : 'text-slate-500'"
                class="px-8 py-5 font-semibold">
                Pemasukan
            </button>

            <button
                @click="tab='pengeluaran'"
                :class="tab=='pengeluaran'
            ? 'border-b-4 border-red-600 text-red-600'
            : 'text-slate-500'"
                class="px-8 py-5 font-semibold">
                Pengeluaran
            </button>
        </div>

        <div
            x-show="tab=='pemasukan'"
            class="p-8">
            @include('admin.keuangan.pemasukan.table')
        </div>

        <div
            x-show="tab=='pengeluaran'"
            class="p-8">
            @include('admin.keuangan.pengeluaran.table')
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus data?',
                text: 'Data tidak dapat dikembalikan.',
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

<script>
    const ctx = document.getElementById('chartKeuangan');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],

            datasets: [

                {
                    label: 'Pemasukan',

                    data: @json($chartPemasukan),

                    backgroundColor: '#10b981',

                    borderRadius: 10
                },

                {
                    label: 'Pengeluaran',

                    data: @json($chartPengeluaran),

                    backgroundColor: '#ef4444',

                    borderRadius: 10
                }

            ]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false
            },

            plugins: {

                legend: {
                    position: 'top'
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return context.dataset.label +
                                ' : Rp ' +
                                new Intl.NumberFormat('id-ID').format(context.raw);

                        }

                    }

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value) {

                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID').format(value);

                        }

                    }

                }

            }

        }

    });
</script>

@endpush