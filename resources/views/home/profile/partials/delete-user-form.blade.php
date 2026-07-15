<section>

    <div class="mb-8">

        <h3 class="text-2xl font-bold text-red-600">

            Hapus Akun

        </h3>

        <p class="text-slate-500 mt-2 leading-8">

            Menghapus akun akan menghilangkan seluruh data Anda secara permanen.
            Tindakan ini tidak dapat dibatalkan.

        </p>

    </div>

    <div class="bg-red-50 border border-red-200 rounded-2xl p-6">

        <div class="flex items-start gap-4">

            <div
                class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">

                <i class="fa-solid fa-triangle-exclamation text-red-600"></i>

            </div>

            <div>

                <h4 class="font-bold text-red-700">

                    Peringatan

                </h4>

                <p class="text-slate-600 mt-2">

                    Pastikan Anda benar-benar ingin menghapus akun ini.

                </p>

            </div>

        </div>

    </div>

    <form
        method="POST"
        action="{{ route('user.profile.destroy') }}"
        class="mt-8 space-y-6">

        @csrf
        @method('DELETE')

        <div>

            <label class="block mb-2 font-semibold text-slate-700">

                Masukkan Password

            </label>

            <input
                type="password"
                name="password"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-red-500 focus:ring-red-500">

            <x-input-error
                :messages="$errors->userDeletion->get('password')"
                class="mt-2" />

        </div>

        <button
            type="submit"
            onclick="return confirm('Yakin ingin menghapus akun ini?')"
            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-semibold transition">

            Hapus Akun

        </button>

    </form>

</section>