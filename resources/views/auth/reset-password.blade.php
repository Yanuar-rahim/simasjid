@extends('layouts.guest')

@section('content')

<div class="min-h-screen flex">

    {{-- FORM --}}
    <div class="flex-1 flex items-center justify-center px-8 lg:px-16 py-10">

        <div
            class="w-full max-w-lg"
            data-aos="fade-right"
            data-aos-duration="1000">

            <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-10">

                {{-- Header --}}
                <div class="text-center">

                    <div
                        class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-100"
                        data-aos="zoom-in"
                        data-aos-delay="200">

                        <i class="fa-solid fa-lock text-3xl text-emerald-600"></i>

                    </div>

                    <h1
                        class="mt-6 text-4xl font-bold text-slate-800"
                        data-aos="fade-up"
                        data-aos-delay="300">

                        Reset Password

                    </h1>

                    <p
                        class="mt-4 text-slate-500 leading-7"
                        data-aos="fade-up"
                        data-aos-delay="400">

                        Masukkan password baru untuk akun Anda.

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

                    {{-- Email --}}
                    <div>

                        <label class="font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            readonly
                            value="{{ old('email',$request->email) }}"
                            class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-5 py-3 text-slate-500">

                        @error('email')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    {{-- Password --}}
                    <div>

                        <label class="font-medium">
                            Password Baru
                        </label>

                        <div class="relative">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 pr-12 focus:border-emerald-600 focus:ring-emerald-600">

                            <button
                                type="button"
                                onclick="togglePassword('password','iconPassword')"
                                class="absolute right-4 top-6 text-slate-400 hover:text-emerald-600">

                                <i
                                    id="iconPassword"
                                    class="fa-solid fa-eye">
                                </i>

                            </button>

                        </div>

                        @error('password')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    {{-- Konfirmasi --}}
                    <div>

                        <label class="font-medium">
                            Konfirmasi Password
                        </label>

                        <div class="relative">

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="mt-2 w-full rounded-2xl border border-slate-300 px-5 py-3 pr-12 focus:border-emerald-600 focus:ring-emerald-600">

                            <button
                                type="button"
                                onclick="togglePassword('password_confirmation','iconPassword2')"
                                class="absolute right-4 top-6 text-slate-400 hover:text-emerald-600">

                                <i
                                    id="iconPassword2"
                                    class="fa-solid fa-eye">
                                </i>

                            </button>

                        </div>

                        @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-emerald-600 py-3 font-semibold text-white transition-all duration-300 hover:scale-[1.02] hover:bg-emerald-700">

                        <i class="fa-solid fa-key mr-2"></i>
                        Simpan Password Baru

                    </button>

                </form>

                <div
                    class="mt-8 text-center"
                    data-aos="fade-up"
                    data-aos-delay="700">

                    <a
                        href="{{ route('login') }}"
                        class="font-medium text-emerald-700 hover:text-emerald-800">

                        ← Kembali ke Login

                    </a>

                </div>

            </div>

        </div>

    </div>

    {{-- Banner --}}
    <div
        class="relative hidden lg:flex lg:w-1/2 overflow-hidden bg-emerald-700"
        data-aos="fade-left"
        data-aos-duration="1200">

        <img
            src="{{ asset('assets/images/hero-masjid.png') }}"
            class="absolute inset-0 w-full h-full object-cover opacity-25">

        <div class="relative z-10 flex flex-col justify-center px-16 text-white">

            <h1 class="text-5xl font-bold leading-tight">
                Password Baru,
                <br>
                Keamanan Baru
            </h1>

            <p class="mt-6 text-lg leading-8 text-emerald-100">

                Gunakan password yang kuat agar akun SIMASJID
                tetap aman dari akses yang tidak sah.

            </p>

            <div class="mt-12 grid grid-cols-2 gap-8">

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
                        Mudah
                    </h3>

                    <p class="text-emerald-100">
                        Reset dalam hitungan menit
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function togglePassword(id, iconId){

    let input=document.getElementById(id);
    let icon=document.getElementById(iconId);

    if(input.type==="password"){
        input.type="text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }else{
        input.type="password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

}
</script>

@endsection