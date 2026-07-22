@extends('layouts.admin')

@section('content')

<div class="max-w-8xl mx-auto space-y-8">
    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Ubah Password
        </h1>
        <p class="text-slate-500 mt-2">
            Demi keamanan akun administrator, gunakan password yang kuat dan mudah Anda ingat.
        </p>
    </div>
    {{-- Alert --}}
    @if(session('success'))
    <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
        {{ session('success') }}
    </div>
    @endif
    {{-- Card --}}
    <div class="dashboard-card">
        <form
            action="{{ route('admin.profile.password.update') }}"
            method="POST"
            class="space-y-8">
            @csrf
            @method('PATCH')
            {{-- Password Lama --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password Lama
                </label>
                <div class="relative">
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        class="w-full rounded-xl border border-slate-300 px-5 py-3 pr-12 focus:border-emerald-600 focus:ring-emerald-600">
                    <button
                        type="button"
                        onclick="togglePassword('current_password',this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                @error('current_password')
                <p class="text-red-600 text-sm mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>
            {{-- Password Baru --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password Baru
                </label>
                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full rounded-xl border border-slate-300 px-5 py-3 pr-12 focus:border-emerald-600 focus:ring-emerald-600">
                    <button
                        type="button"
                        onclick="togglePassword('password',this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <div class="mt-4">
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div
                            id="strengthBar"
                            class="h-2 rounded-full transition-all duration-300 w-0 bg-red-500">
                        </div>
                    </div>
                    <p
                        id="strengthText"
                        class="text-sm text-slate-500 mt-2">
                        Password belum diisi
                    </p>
                </div>
                <div class="grid md:grid-cols-2 gap-2 text-sm mt-4">
                    <div id="ruleLength" class="text-slate-500">
                        ✖ Minimal 8 karakter
                    </div>
                    <div id="ruleUpper" class="text-slate-500">
                        ✖ Huruf besar
                    </div>
                    <div id="ruleNumber" class="text-slate-500">
                        ✖ Angka
                    </div>
                    <div id="ruleSymbol" class="text-slate-500">
                        ✖ Simbol
                    </div>
                </div>
                @error('password')
                <p class="text-red-600 text-sm mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>
            {{-- Konfirmasi --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Konfirmasi Password Baru
                </label>
                <div class="relative">
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded-xl border border-slate-300 px-5 py-3 pr-12 focus:border-emerald-600 focus:ring-emerald-600">
                    <button
                        type="button"
                        onclick="togglePassword('password_confirmation',this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>
            {{-- Tombol --}}
            <div class="flex justify-end gap-4">
                <a
                    href="{{ route('admin.profile') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">
                    Batal
                </a>
                <button
                    class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    Simpan Password
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function togglePassword(id, button) {
        let input = document.getElementById(id);
        let icon = button.querySelector("i");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
<script>
    function togglePassword(id, button) {

        let input = document.getElementById(id);
        let icon = button.querySelector("i");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }

    }

    /* ======================================
       PASSWORD STRENGTH
    ====================================== */

    const passwordInput = document.getElementById("password");

    const strengthBar = document.getElementById("strengthBar");
    const strengthText = document.getElementById("strengthText");

    const ruleLength = document.getElementById("ruleLength");
    const ruleUpper = document.getElementById("ruleUpper");
    const ruleNumber = document.getElementById("ruleNumber");
    const ruleSymbol = document.getElementById("ruleSymbol");

    passwordInput.addEventListener("input", function() {

        const password = this.value;

        let score = 0;

        const length = password.length >= 8;
        const upper = /[A-Z]/.test(password);
        const number = /[0-9]/.test(password);
        const symbol = /[^A-Za-z0-9]/.test(password);

        updateRule(ruleLength, length, "Minimal 8 karakter");
        updateRule(ruleUpper, upper, "Huruf besar");
        updateRule(ruleNumber, number, "Angka");
        updateRule(ruleSymbol, symbol, "Simbol");

        if (length) score++;
        if (upper) score++;
        if (number) score++;
        if (symbol) score++;

        if (password.length === 0) {
            strengthBar.style.width = "0%";
            strengthBar.className = "h-2 rounded-full transition-all duration-300 bg-red-500";
            strengthText.innerHTML = "Password belum diisi";
            strengthText.className = "text-sm text-slate-500 mt-2";
            return;
        }
        if (score <= 1) {
            strengthBar.style.width = "25%";
            strengthBar.className = "h-2 rounded-full transition-all duration-300 bg-red-500";
            strengthText.innerHTML = "Password Lemah";
            strengthText.className = "text-sm text-red-600 mt-2";
        } else if (score == 2) {
            strengthBar.style.width = "50%";
            strengthBar.className = "h-2 rounded-full transition-all duration-300 bg-yellow-500";
            strengthText.innerHTML = "Password Cukup";
            strengthText.className = "text-sm text-yellow-600 mt-2";
        } else if (score == 3) {
            strengthBar.style.width = "75%";
            strengthBar.className = "h-2 rounded-full transition-all duration-300 bg-lime-500";
            strengthText.innerHTML = "Password Baik";
            strengthText.className = "text-sm text-lime-600 mt-2";
        } else {
            strengthBar.style.width = "100%";
            strengthBar.className = "h-2 rounded-full transition-all duration-300 bg-green-600";
            strengthText.innerHTML = "Password Sangat Kuat";
            strengthText.className = "text-sm text-green-600 mt-2";
        }
    });

    function updateRule(element, valid, text) {
        if (valid) {
            element.innerHTML = "✔ " + text;
            element.className = "text-green-600";
        } else {
            element.innerHTML = "✖ " + text;
            element.className = "text-slate-500";
        }
    }
</script>
@endsection