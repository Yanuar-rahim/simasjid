<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Two-Factor Authentication | SIMASJID</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-slate-100 flex items-center justify-center px-4">
<div class="w-full max-w-md">
    <div class="bg-white rounded-3xl shadow-2xl p-10">
        <div class="text-center">
            <div class="w-24 h-24 mx-auto rounded-full bg-emerald-100 flex items-center justify-center">
                <i class="fa-solid fa-shield-halved text-4xl text-emerald-600"></i>
            </div>
            <h1 class="mt-6 text-3xl font-bold text-slate-800">
                Two-Factor Authentication
            </h1>
            <p class="mt-4 text-slate-500 leading-7">
                Masukkan kode 6 digit yang muncul
                pada aplikasi Google Authenticator.
            </p>
        </div>
        <form
            action="{{ route('user.2fa.verify') }}"
            method="POST"
            class="mt-10">
            @csrf
            <div>
                <label class="block font-medium text-slate-700 mb-3">
                    Kode Verifikasi
                </label>
                <input
                    type="text"
                    name="code"
                    maxlength="6"
                    autofocus
                    autocomplete="one-time-code"
                    placeholder="000000"
                    class="w-full rounded-2xl border border-slate-300 py-4 text-center text-3xl tracking-[10px] font-bold focus:border-emerald-600 focus:ring-emerald-600">
                @error('code')
                <p class="mt-3 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <button
                type="submit"
                class="mt-8 w-full rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white py-4 font-semibold transition">
                <i class="fa-solid fa-circle-check mr-2"></i>
                Verifikasi
            </button>
        </form>
        <div class="mt-8 pt-6">
            <p class="text-center text-sm text-slate-500">
                Tidak dapat mengakses Google Authenticator?
            </p>
            <form
                action="{{ route('logout') }}"
                method="POST"
                class="mt-4">
                @csrf
                <button
                    class="w-full rounded-2xl border border-red-300 text-red-600 hover:bg-red-50 py-3 transition">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>