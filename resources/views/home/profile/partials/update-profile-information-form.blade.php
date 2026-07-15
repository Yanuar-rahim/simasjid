<section>

    <header class="mb-8">

        <div class="flex items-center gap-6">

            @if(Auth::user()->foto)

            <img
                src="{{ asset('storage/' . Auth::user()->foto) }}"
                class="w-24 h-24 rounded-full object-cover border-4 border-emerald-500">

            @else

            <div
                class="w-24 h-24 rounded-full bg-emerald-600 text-white flex items-center justify-center text-3xl font-bold">

                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

            </div>

            @endif

            <div>

                <h2 class="text-3xl font-bold text-slate-800">

                    {{ Auth::user()->name }}

                </h2>

                <p class="text-slate-500 mt-2">

                    {{ Auth::user()->email }}

                </p>

                <span class="inline-block mt-3 px-4 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">

                    {{ ucfirst(Auth::user()->role) }}

                </span>

            </div>

        </div>

    </header>

    <div class="pt-8">

        <h3 class="text-2xl font-bold text-slate-800">

            Informasi Profil

        </h3>

        <p class="text-slate-500 mt-2">

            Perbarui informasi akun Anda.

        </p>

    </div>

    <form method="post"
        action="{{ route('user.profile.update') }}"
        enctype="multipart/form-data"
        class="mt-8 space-y-6">

        @csrf
        @method('patch')

        <!-- Nama -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Nama Lengkap
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', auth()->user()->name) }}"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2" />

        </div>

        <!-- Email -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', auth()->user()->email) }}"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2" />

        </div>

        <!-- Nomor HP -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Nomor HP
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', auth()->user()->phone) }}"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">

        </div>

        <!-- Alamat -->
        <div>

            <label class="block mb-2 font-semibold text-slate-700">
                Alamat
            </label>

            <textarea
                name="address"
                rows="4"
                class="w-full mt-3 px-5 py-2 text-lg rounded-2xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 transition">{{ old('address', auth()->user()->address) }}</textarea>

        </div>

        <!-- Foto -->
        <!-- Foto Profil -->
        <div
            x-data="{
        photoName: null,
        photoPreview: null
    }">

            <label class="block mb-3 font-semibold text-slate-700">
                Foto Profil
            </label>

            <!-- Preview -->
            <div class="flex items-center gap-6">

                <div>

                    <template x-if="!photoPreview">

                        @if(Auth::user()->foto)

                        <img
                            src="{{ asset('storage/'.Auth::user()->foto) }}"
                            class="w-28 h-28 rounded-full object-cover border-4 border-emerald-500">

                        @else

                        <div
                            class="w-28 h-28 rounded-full bg-emerald-600 text-white flex items-center justify-center text-4xl font-bold">

                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                        </div>

                        @endif

                    </template>

                    <template x-if="photoPreview">

                        <img
                            :src="photoPreview"
                            class="w-28 h-28 rounded-full object-cover border-4 border-emerald-500">

                    </template>

                </div>

                <div class="space-y-3">

                    <input
                        type="file"
                        name="foto"
                        class="hidden"
                        x-ref="photo"
                        x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };

                    reader.readAsDataURL($refs.photo.files[0]);
                ">

                    <button
                        type="button"
                        @click.prevent="$refs.photo.click()"
                        class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white transition">

                        <i class="fa-solid fa-camera mr-2"></i>

                        Pilih Foto

                    </button>

                    <template x-if="photoName">

                        <p class="text-sm text-slate-500">

                            <span class="font-semibold">
                                File:
                            </span>

                            <span x-text="photoName"></span>

                        </p>

                    </template>

                    <p class="text-xs text-slate-400">
                        JPG, PNG, WEBP (Maks. 2MB)
                    </p>

                </div>

            </div>

        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center gap-4 pt-4">

            <button
                type="submit"
                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-semibold transition">

                Simpan Perubahan

            </button>

            @if (session('status') === 'profile-updated')

            <span class="text-emerald-600 font-medium">

                Profil berhasil diperbarui.

            </span>

            @endif

        </div>

    </form>

</section>