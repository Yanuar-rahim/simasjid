<?php

namespace App\Http\Controllers\Home;

use App\Models\Masjid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $masjid = Masjid::first();

        return view('home.profile.index', compact('masjid'));
    }

    public function edit()
    {
        return view('home.profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {

            $path = $request->file('foto')->store('profile', 'public');

            $user->foto = $path;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {

            return back()->withErrors([
                'password_lama' => 'Password lama salah.'
            ]);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}