<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | SIMASJID</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans bg-gradient-to-br from-emerald-50 via-white to-slate-100">

    <div class="min-h-screen flex">

        <!-- FORM -->
        <div class="flex-1 flex items-center justify-center px-8 lg:px-16 py-10">

            <div
                class="w-full max-w-lg"
                data-aos="fade-right">

                <div class="text-center">

                    <div
                        class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100">

                        <i class="fa-solid fa-key text-3xl text-emerald-700"></i>

                    </div>

                    <h1 class="mt-6 text-4xl font-bold text-slate-800">

                        Lupa Password?

                    </h1>

                    <p class="mt-4 text-slate-500 leading-7">

                        Masukkan alamat email yang terdaftar.
                        Kami akan mengirimkan tautan untuk mengatur ulang password Anda.

                    </p>

                </div>

                @if (session('status'))
                <div
                    class="mt-8 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-700">

                    {{ session('status') }}

                </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                    class="mt-10 space-y-6">

                    @csrf

                    <div>

                        <label class="font-medium">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus

                            class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 focus:border-emerald-600 focus:ring-emerald-600">

                        @error('email')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-emerald-600 py-3 font-semibold text-white transition-all duration-300 hover:scale-[1.02] hover:bg-emerald-700">

                        <i class="fa-solid fa-paper-plane mr-2"></i>

                        Kirim Link Reset Password

                    </button>

                </form>

                <div class="mt-8 text-center">

                    <a
                        href="{{ route('login') }}"
                        class="font-medium text-emerald-700 transition hover:text-emerald-800">

                        ← Kembali ke Login

                    </a>

                </div>

            </div>

        </div>

        <!-- BANNER -->

        <div
            class="relative hidden lg:flex lg:w-1/2 overflow-hidden bg-emerald-700"
            data-aos="fade-left">

            <img
                src="{{ asset('assets/images/hero-masjid.png') }}"
                class="absolute inset-0 h-full w-full object-cover opacity-25">

            <div
                class="relative z-10 flex flex-col justify-center px-16 text-white">

                <h1 class="text-5xl font-bold leading-tight">

                    Keamanan Akun Anda
                    Prioritas Kami

                </h1>

                <p class="mt-6 text-lg leading-8 text-emerald-100">

                    Jangan khawatir apabila Anda lupa password.
                    Kami akan membantu Anda mengatur ulang akun dengan
                    proses yang aman dan cepat.

                </p>

                <div class="mt-12 grid grid-cols-2 gap-8">

                    <div>

                        <h3 class="text-3xl font-bold">

                            Aman

                        </h3>

                        <p class="text-emerald-100">

                            Reset melalui Email

                        </p>

                    </div>

                    <div>

                        <h3 class="text-3xl font-bold">

                            Cepat

                        </h3>

                        <p class="text-emerald-100">

                            Hanya beberapa langkah

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>