<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi | Sistem Informasi Manajemen Masjid</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('partials.navbar-user')
    <section class="pt-40 pb-24 bg-gradient-to-br from-emerald-700 via-emerald-600 to-green-600 text-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-28">
            <div class="text-center" data-aos="fade-up">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm">
                    <i class="fa-solid fa-hand-holding-heart text-5xl"></i>
                </div>
                <span
                    class="block mt-6 font-semibold tracking-widest uppercase text-emerald-100">
                    Donasi Online
                </span>
                <h1
                    class="text-5xl font-bold mt-4">
                    Mari Berbagi Kebaikan
                </h1>
                <p
                    class="max-w-3xl mx-auto mt-6 text-emerald-100 leading-8 text-lg">
                    Setiap donasi yang Anda berikan akan membantu operasional masjid,
                    kegiatan dakwah, pendidikan Islam, serta berbagai kegiatan sosial
                    masyarakat.
                </p>
            </div>
                <div class="grid md:grid-cols-3 gap-6 px-8 sm:px-14 lg:px-28 mt-16" data-aos="fade-up" data-aos-delay="100">
                    <div class="rounded-2xl bg-white/20 p-6 text-center">
                        <div class="text-3xl font-bold">100%</div>
                        <div class="mt-2 text-sm text-emerald-50">Transparan</div>
                    </div>
                    <div class="rounded-2xl bg-white/20 p-6 text-center">
                        <div class="text-3xl font-bold">24/7</div>
                        <div class="mt-2 text-sm text-emerald-50">Aman & Cepat</div>
                    </div>
                    <div class="rounded-2xl bg-white/20 p-6 text-center">
                        <div class="text-3xl font-bold">Real-time</div>
                        <div class="mt-2 text-sm text-emerald-50">Riwayat Donasi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-20 pb-24 bg-white">
        <div class="max-w-8xl mx-auto px-8 sm:px-14 lg:px-20">
            <div class="grid lg:grid-cols-3 gap-10">
                <!-- ===========================
            FORM DONASI
            ============================ -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <form
                        action="{{ route('user.donasi.store')}}"
                        method="POST"
                        class="bg-white rounded-[35px] shadow-xl p-10">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <label class="font-semibold text-slate-700">
                                    Nama Donatur
                                </label>
                                <input
                                    type="text"
                                    value="{{ Auth::user()->name }}"
                                    readonly
                                    class="w-full mt-3 px-5 py-4 rounded-2xl bg-slate-100 border border-slate-200">
                            </div>
                            <div>
                                <label class="font-semibold text-slate-700">
                                    Email
                                </label>
                                <input
                                    type="email"
                                    value="{{ Auth::user()->email }}"
                                    readonly
                                    class="w-full mt-3 px-5 py-4 rounded-2xl bg-slate-100 border border-slate-200">
                            </div>
                            <div>
                                <label class="font-semibold text-slate-700">
                                    Jenis Donasi
                                </label>
                                <select
                                    name="jenis_donasi"
                                    id="jenisDonasi"
                                    class="w-full mt-3 px-5 py-4 rounded-2xl border border-slate-300">
                                    <option value="Infak">Infak</option>
                                    <option value="Sedekah">Sedekah</option>
                                    <option value="Wakaf">Wakaf</option>
                                    <option value="Pembangunan">Pembangunan</option>
                                </select>
                            </div>
                            <div>
                                <label class="font-semibold text-slate-700">
                                    Nominal Donasi
                                </label>
                                <input
                                    id="nominal"
                                    type="number"
                                    name="nominal"
                                    placeholder="Masukkan Nominal"
                                    class="w-full mt-3 px-5 py-4 rounded-2xl border border-slate-300 focus:ring-emerald-600 focus:border-emerald-600">
                            </div>
                        </div>
                        <!-- Nominal Cepat -->
                        <div class="mt-10">
                            <label class="font-semibold text-slate-700">
                                Pilih Nominal Cepat
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-5">
                                <button
                                    type="button"
                                    class="nominal-btn py-4 rounded-2xl border hover:bg-emerald-50 hover:border-emerald-600 transition"
                                    data-value="10000">
                                    Rp10.000
                                </button>
                                <button
                                    type="button"
                                    class="nominal-btn py-4 rounded-2xl border hover:bg-emerald-50 hover:border-emerald-600 transition"
                                    data-value="20000">
                                    Rp20.000
                                </button>
                                <button
                                    type="button"
                                    class="nominal-btn py-4 rounded-2xl border hover:bg-emerald-50 hover:border-emerald-600 transition"
                                    data-value="50000">
                                    Rp50.000
                                </button>
                                <button
                                    type="button"
                                    class="nominal-btn py-4 rounded-2xl border hover:bg-emerald-50 hover:border-emerald-600 transition"
                                    data-value="100000">
                                    Rp100.000
                                </button>
                                <button
                                    type="button"
                                    class="nominal-btn py-4 rounded-2xl border hover:bg-emerald-50 hover:border-emerald-600 transition"
                                    data-value="250000">
                                    Rp250.000
                                </button>
                                <button
                                    type="button"
                                    class="nominal-btn py-4 rounded-2xl border hover:bg-emerald-50 hover:border-emerald-600 transition"
                                    data-value="500000">
                                    Rp500.000
                                </button>
                            </div>
                        </div>
                        <!-- Catatan -->
                        <div class="mt-10">
                            <label class="font-semibold text-slate-700">
                                Pesan / Doa (Opsional)
                            </label>
                            <textarea
                                name="pesan"
                                rows="5"
                                placeholder="Tuliskan doa atau pesan..."
                                class="w-full mt-3 px-5 py-4 rounded-2xl border border-slate-300 focus:ring-emerald-600 focus:border-emerald-600"></textarea>
                        </div>
                        <button
                            type="submit"
                            class="mt-10 w-full py-5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-lg transition shadow-lg hover:shadow-xl">
                            <i class="fa-solid fa-paper-plane mr-2"></i>
                            Kirim Donasi
                        </button>
                    </form>
                </div>
                <!-- ======================
            SIDEBAR
            ======================= -->
                <div class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                    <!-- Ringkasan -->
                    <div class="bg-white rounded-[35px] shadow-xl p-8">
                        <h3 class="text-2xl font-bold">
                            Ringkasan Donasi
                        </h3>
                        <div class="space-y-6 mt-8">
                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Jenis Donasi
                                </span>
                                <span
                                    id="previewJenis"
                                    class="font-semibold">
                                    Infak
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Nominal
                                </span>
                                <span
                                    id="previewNominal"
                                    class="font-bold text-emerald-600">
                                    Rp0
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Biaya Admin
                                </span>
                                <span>
                                    Gratis
                                </span>
                            </div>
                            <hr>
                            <div class="flex justify-between text-xl">
                                <span class="font-bold">
                                    Total
                                </span>
                                <span
                                    id="previewTotal"
                                    class="font-bold text-emerald-600">
                                    Rp0
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Progress -->
                    <div class="bg-white rounded-[35px] shadow-xl p-8" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-2xl font-bold">
                            Target Pembangunan
                        </h3>
                        <p class="text-slate-500 mt-3">
                            Renovasi Masjid Tahun 2026
                        </p>
                        <div class="mt-8">
                            <div class="flex justify-between mb-2">
                                <span>
                                    Rp75.000.000
                                </span>
                                <span>
                                    Rp100.000.000
                                </span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-4">
                                <div
                                    class="bg-emerald-600 h-4 rounded-full w-3/4">
                                </div>
                            </div>
                            <p class="mt-4 text-slate-500">
                                75% target pembangunan telah tercapai.
                            </p>
                        </div>
                    </div>
                    <!-- Aman -->
                    <div
                        class="rounded-[35px] bg-gradient-to-br from-emerald-600 to-green-700 p-8 text-white"
                        data-aos="fade-up" data-aos-delay="200">
                        <i class="fa-solid fa-shield-halved text-5xl"></i>
                        <h3
                            class="text-3xl font-bold mt-6">
                            Donasi Aman
                        </h3>
                        <p
                            class="mt-5 text-emerald-100 leading-8">
                            Seluruh transaksi dicatat secara digital dan dapat
                            dipantau melalui halaman riwayat donasi Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    @php
        $riwayatUrl = route('user.riwayat');
    @endphp

    @if(isset($snapToken) && $snapToken)
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const riwayatUrl = "{{ $riwayatUrl }}";

                if (window.snap) {
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            window.location.href = riwayatUrl;
                        },
                        onPending: function(result){
                            window.location.href = riwayatUrl;
                        },
                        onError: function(result){
                            alert('Pembayaran gagal. Silakan coba lagi.');
                        }
                    });
                }
            });
        </script>
    @endif

</body>

</html>