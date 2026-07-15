<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            $path = $request->file('foto')->store('profile', 'public');

            $admin->foto = $path;
        }

        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        $admin->save();

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->password_lama, $admin->password)) {
            return back()->withErrors([
                'password_lama' => 'Password lama salah.'
            ]);
        }

        $admin->password = Hash::make($request->password);

        $admin->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
