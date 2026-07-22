<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Profil
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('admin.profile.index', [
            'user' => auth()->user(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Edit Profil
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        return view('admin.profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Profil
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        /*
    |--------------------------------------------------------------------------
    | Upload Foto
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('foto')) {

            if ($user->foto && \Storage::disk('public')->exists($user->foto)) {
                \Storage::disk('public')->delete($user->foto);
            }

            $validated['foto'] = $request
                ->file('foto')
                ->store('profile', 'public');
        }

        $user->update($validated);

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Ubah Password
    |--------------------------------------------------------------------------
    */

    public function password()
    {
        return view('admin.profile.password');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Password
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {

            return back()
                ->withErrors([
                    'current_password' => 'Password lama tidak sesuai.',
                ])
                ->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Password berhasil diperbarui.');
    }

    public function deletePhoto()
    {
        $user = auth()->user();
        if ($user->foto) {
            if (Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->update([
                'foto' => null
            ]);
        }

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Foto profil berhasil dihapus.');
    }
}
