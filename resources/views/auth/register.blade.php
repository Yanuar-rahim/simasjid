<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar | SIMASJID</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans bg-gradient-to-br from-emerald-50 via-white to-slate-100">

    <div class="min-h-screen flex">

        <!-- LEFT -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-emerald-700 relative overflow-hidden"
            data-aos="fade-right">

            <img
                src="{{ asset('assets/images/hero-masjid.png') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-30">

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">

                <h1
                    class="text-5xl font-bold"
                    data-aos="fade-up">

                    Bergabung Bersama SIMASJID

                </h1>

                <p
                    class="mt-6 text-lg leading-8 text-emerald-100"
                    data-aos="fade-up"
                    data-aos-delay="200">

                    Daftarkan akun Anda untuk menikmati layanan digital
                    masjid mulai dari donasi online, informasi kegiatan,
                    hingga transparansi keuangan.

                </p>

                <div
                    class="grid grid-cols-2 gap-8 mt-12">

                    <div>

                        <h3 class="text-3xl font-bold">

                            100%

                        </h3>

                        <p class="text-emerald-100">

                            Aman

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

        <div class="flex-1 flex justify-center items-center py-10 px-6">

            <div
                class="w-full max-w-lg"
                data-aos="fade-left"
                data-aos-duration="1000">

                <div class="text-center">

                    <div 
                        class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100"
                        data-aos="zoom-in"
                        data-aos-delay="200">

                        <i class="fa-solid fa-user-plus text-3xl text-emerald-700"></i>

                    </div>

                    <h2 
                        class="text-3xl font-bold mt-6"
                        data-aos="fade-up"
                        data-aos-delay="300">

                        Registrasi Akun

                    </h2>

                    <p 
                        class="text-slate-500 mt-2"
                        data-aos="fade-up"
                        data-aos-delay="400">

                        Lengkapi data berikut untuk membuat akun.

                    </p>

                </div>

                <form
                    action="{{ route('register') }}"
                    method="POST"
                    class="space-y-5 mt-10"
                    data-aos="fade-up"
                    data-aos-delay="500">

                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="font-medium">Nama Lengkap</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full mt-2 rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-600 focus:border-emerald-600">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="font-medium">Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full mt-2 rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-600 focus:border-emerald-600">
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="font-medium">Nomor HP</label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            class="w-full mt-2 rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-600 focus:border-emerald-600">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="font-medium">Password</label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full mt-2 rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-600 focus:border-emerald-600">
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="font-medium">Konfirmasi Password</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full mt-2 rounded-2xl border border-slate-300 px-5 py-3 focus:ring-emerald-600 focus:border-emerald-600">
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 hover:scale-[1.02] transition-all duration-300 rounded-2xl py-3 text-white font-semibold">

                        Daftar Sekarang

                    </button>

                    <div class="text-center mt-8">
    
                        <p class="text-slate-500">
    
                            Sudah memiliki akun?
    
                            <a
                                href="{{ route('login') }}"
                                class="font-semibold text-emerald-700 hover:text-emerald-800">
    
                                Masuk
    
                            </a>
    
                        </p>
    
                        <!-- <a
                        href="/"
                        class="inline-block mt-5 text-slate-500 hover:text-emerald-700">
    
                        ← Kembali ke Beranda
    
                    </a> -->
    
                    </div>

                </form>


            </div>

        </div>

    </div>

</body>

</html>