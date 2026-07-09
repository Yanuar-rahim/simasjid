<section>

    <div class="mb-8">

        <h3 class="text-2xl font-bold text-slate-800">
            Ubah Password
        </h3>

        <p class="text-slate-500 mt-2">
            Gunakan password yang kuat agar akun Anda tetap aman.
        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="space-y-6">

        @csrf
        @method('PUT')

        <!-- Password Lama -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Password Lama
            </label>

            <input
                type="password"
                name="current_password"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />

        </div>

        <!-- Password Baru -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2" />

        </div>

        <!-- Konfirmasi -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">

        </div>

        <div class="flex items-center gap-4 pt-4">

            <button
                type="submit"
                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-semibold transition">

                Simpan Password

            </button>

            @if(session('status') === 'password-updated')

            <span class="text-emerald-600 font-medium">
                Password berhasil diperbarui.
            </span>

            @endif

        </div>

    </form>

</section>