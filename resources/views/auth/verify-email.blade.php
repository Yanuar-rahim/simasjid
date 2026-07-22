<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | SIMASJID</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans bg-gradient-to-br from-emerald-50 via-white to-slate-100">
    <div class="min-h-screen flex">
        {{-- LEFT --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-emerald-700 relative overflow-hidden"
            data-aos="fade-right"
            data-aos-duration="1200">
            <img
                src="{{ asset('assets/images/hero-masjid.png') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-25">
            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <h1
                    class="text-5xl font-bold"
                    data-aos="fade-down"
                    data-aos-delay="200">
                    SIMASJID
                </h1>
                <p
                    class="mt-6 text-lg leading-8 text-emerald-100"
                    data-aos="fade-up"
                    data-aos-delay="400">
                    Sistem Informasi Manajemen Masjid &
                    Keuangan Digital yang transparan,
                    modern, dan terpercaya.
                </p>
            </div>
        </div>
        {{-- RIGHT --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div
                class="w-full max-w-lg"
                data-aos="fade-left"
                data-aos-duration="1000">
                <div class="bg-white rounded-3xl shadow-xl p-10 border border-slate-200">
                    <div class="text-center">
                        <div
                            class="mx-auto w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center"
                            data-aos="zoom-in"
                            data-aos-delay="200">
                            <i class="fa-solid fa-envelope-circle-check text-4xl text-emerald-600"></i>
                        </div>
                        <h1
                            class="mt-6 text-3xl font-bold text-slate-800"
                            data-aos="fade-up"
                            data-aos-delay="300">
                            Verifikasi Email
                        </h1>
                        <p
                            class="mt-4 text-slate-500 leading-7"
                            data-aos="fade-up"
                            data-aos-delay="450">
                            Terima kasih telah mendaftar.
                            <br><br>
                            Kami telah mengirimkan email verifikasi ke alamat email Anda.
                            Silakan buka email tersebut dan klik tombol
                            <strong>"Verifikasi Email"</strong>
                            sebelum login ke SIMASJID.
                        </p>
                    </div>
                    @if (session('status') == 'verification-link-sent')
                    <div
                        class="mt-8 rounded-2xl bg-green-50 border border-green-200 p-4"
                        data-aos="fade-up"
                        data-aos-delay="600">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-green-600 mt-1"></i>
                            <p class="text-green-700 text-sm">
                                Link verifikasi baru berhasil dikirim
                                ke email Anda.
                            </p>
                        </div>
                    </div>
                    @endif
                    <div
                        class="mt-10 space-y-4"
                        data-aos="fade-up"
                        data-aos-delay="700">
                        <form
                            method="POST"
                            action="{{ route('verification.send') }}">
                            @csrf
                            <button
                                type="submit"
                                class="w-full rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white py-3 font-semibold transition">
                                <i class="fa-solid fa-paper-plane mr-2"></i>
                                Kirim Ulang Email Verifikasi
                            </button>
                        </form>
                        <form
                            method="POST"
                            action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="w-full rounded-2xl border border-red-300 text-red-600 hover:bg-red-50 py-3 font-semibold transition">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 900,
            once: true,
            easing: 'ease-in-out',
        });
    </script>
</body>
</html>