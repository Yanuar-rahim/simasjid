<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | SIMASJID</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    {{-- AOS --}}
    <link
        href="https://unpkg.com/aos@2.3.4/dist/aos.css"
        rel="stylesheet">

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

            <div
                class="relative z-10 flex flex-col justify-center px-16 text-white">

                <h1
                    class="text-5xl font-bold leading-tight"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    Reset Password
                </h1>

                <p
                    class="mt-6 text-lg leading-8 text-emerald-100"
                    data-aos="fade-up"
                    data-aos-delay="400">

                    Buat password baru yang aman agar akun SIMASJID Anda
                    tetap terlindungi.

                </p>

                <div
                    class="mt-12 grid grid-cols-2 gap-8"
                    data-aos="fade-up"
                    data-aos-delay="600">

                    <div>
                        <h3 class="text-3xl font-bold">
                            Aman
                        </h3>
                        <p class="text-emerald-100">
                            Password Terenkripsi
                        </p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold">
                            Cepat
                        </h3>
                        <p class="text-emerald-100">
                            Hanya Sekali Klik
                        </p>
                    </div>

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="flex-1 flex items-center justify-center px-8 py-12">

            <div
                class="w-full max-w-lg"
                data-aos="fade-left"
                data-aos-duration="1000">

                <div class="text-center">

                    <div
                        class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100"
                        data-aos="zoom-in"
                        data-aos-delay="200">

                        <i class="fa-solid fa-lock text-3xl text-emerald-700"></i>

                    </div>

                    <h2
                        class="mt-6 text-3xl font-bold"
                        data-aos="fade-up"
                        data-aos-delay="300">

                        Password Baru

                    </h2>

                    <p
                        class="text-slate-500 mt-3"
                        data-aos="fade-up"
                        data-aos-delay="400">

                        Silakan masukkan password baru
                        untuk akun Anda.

                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('password.store') }}"
                    class="mt-10 space-y-6"
                    data-aos="fade-up"
                    data-aos-delay="500">

                    @csrf

                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}">

                    {{-- EMAIL --}}
                    <div>

                        <label class="font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email',$request->email) }}"
                            readonly
                            class="w-full mt-2 rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3 text-slate-600">

                        @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    {{-- PASSWORD --}}
                    <div>

                        <label class="font-medium">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="w-full mt-2 rounded-2xl border border-slate-300
                            focus:border-emerald-600
                            focus:ring-emerald-600
                            px-5 py-3">

                        @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    {{-- PASSWORD CONFIRMATION --}}
                    <div>

                        <label class="font-medium">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="w-full mt-2 rounded-2xl border border-slate-300
                            focus:border-emerald-600
                            focus:ring-emerald-600
                            px-5 py-3">

                        @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700
                        text-white rounded-2xl py-3
                        font-semibold transition duration-300">

                        <i class="fa-solid fa-key mr-2"></i>

                        Simpan Password Baru

                    </button>

                    <div class="text-center">

                        <a
                            href="{{ route('login') }}"
                            class="text-emerald-700 hover:text-emerald-800 font-medium">

                            ← Kembali ke Login

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init({
            once: true,
            duration: 900,
        });
    </script>

</body>

</html>