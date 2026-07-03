<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SIMASJID</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans bg-gradient-to-br from-emerald-50 via-white to-slate-100">

<div class="min-h-screen flex">

    <!-- LEFT -->
    <div class="hidden lg:flex lg:w-1/2 bg-emerald-700 relative overflow-hidden"
    data-aos="fade-right"
    data-aos-duration="1200">

        <img
            src="{{ asset('assets/images/hero-masjid.png') }}"
            class="absolute inset-0 w-full h-full object-cover opacity-30"
            >

        <div class="relative z-10 flex flex-col justify-center px-16 text-white">

            <h1
                class="text-5xl font-bold leading-tight"
                data-aos="fade-up"
                data-aos-delay="200">
                SIMASJID
            </h1>

            <p
                class="mt-6 text-lg leading-8 text-emerald-100"
                data-aos="fade-up"
                data-aos-delay="400">

                Sistem Informasi Manajemen Masjid &
                Keuangan Digital yang transparan,
                modern dan mudah digunakan.

            </p>

            <div
                class="mt-10 flex gap-8"
                data-aos="fade-up"
                data-aos-delay="600">

                <div>

                    <h3 class="text-3xl font-bold">
                        100%
                    </h3>

                    <p class="text-emerald-100">
                        Transparan
                    </p>

                </div>

                <div>

                    <h3 class="text-3xl font-bold">
                        24/7
                    </h3>

                    <p class="text-emerald-100">
                        Online
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="flex-1 flex items-center justify-center px-6 py-12">

        <div
            class="w-full max-w-md"
            data-aos="fade-left"
            data-aos-duration="1000">

            <div class="text-center">

                <div
                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100"
                    data-aos="zoom-in"
                    data-aos-delay="200">

                    <i class="fa-solid fa-mosque text-3xl text-emerald-700"></i>

                </div>

                <h2
                    class="mt-6 text-3xl font-bold"
                    data-aos="fade-up"
                    data-aos-delay="300">

                    Selamat Datang

                </h2>

                <p
                    class="text-slate-500 mt-2"
                    data-aos="fade-up"
                    data-aos-delay="400">

                    Login untuk mengakses dashboard SIMASJID

                </p>

            </div>

            <form
                method="POST"
                action="{{ route('login') }}"
                class="mt-10 space-y-6"
                data-aos="fade-up"
                data-aos-delay="500">

                @csrf

                <!-- Email -->

                <div>

                    <label class="font-medium">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required

                        class="w-full mt-2 rounded-2xl border border-slate-300
                        focus:border-emerald-600
                        focus:ring-emerald-600
                        px-5 py-3">

                </div>

                <!-- Password -->

                <div>

                    <label class="font-medium">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        required

                        class="w-full mt-2 rounded-2xl border border-slate-300
                        focus:border-emerald-600
                        focus:ring-emerald-600
                        px-5 py-3">

                </div>

                <div class="flex justify-between items-center">

                    <label class="flex items-center gap-2">

                        <input type="checkbox" name="remember">

                        <span class="text-sm">

                            Ingat Saya

                        </span>

                    </label>

                    @if(Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-emerald-700 text-sm hover:underline">

                            Lupa Password?

                        </a>

                    @endif

                </div>

                <button
                    class="w-full bg-emerald-600 hover:bg-emerald-700 transition text-white rounded-2xl py-3 font-semibold">

                    Masuk

                </button>

            </form>

            <div
                class="text-center mt-8"
                data-aos="fade-up"
                data-aos-delay="700">

                <a
                    href="/"
                    class="text-slate-500 hover:text-emerald-700">

                    ← Kembali ke Beranda

                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>