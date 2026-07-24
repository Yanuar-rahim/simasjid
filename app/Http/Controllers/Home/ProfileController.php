<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Masjid;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FAQRCode\Google2FA;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $masjid = Masjid::first();

        /*
        |--------------------------------------------------------------------------
        | Target Achievement
        |--------------------------------------------------------------------------
        */

        $targetAktif = 500000;
        $targetEmas = 2000000;
        $targetSahabat = 5000000;
        $minimalDonasiSahabat = 12;

        /*
        |--------------------------------------------------------------------------
        | Data Donasi
        |--------------------------------------------------------------------------
        */

        $donasi = Donasi::where('user_id', $user->id)
            ->where('status', 'Diterima');

        $totalDonasi = (clone $donasi)->sum('nominal');

        $jumlahDonasi = (clone $donasi)->count();

        $donasiTerakhir = (clone $donasi)
            ->latest('tanggal')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Achievement
        |--------------------------------------------------------------------------
        */

        $badgePemula = $jumlahDonasi >= 1;

        $badgeAktif = $totalDonasi >= $targetAktif;

        $badgeEmas = $totalDonasi >= $targetEmas;

        $badgeSahabat =
            $totalDonasi >= $targetSahabat &&
            $jumlahDonasi >= $minimalDonasiSahabat;

        /*
        |--------------------------------------------------------------------------
        | Progress Badge
        |--------------------------------------------------------------------------
        */

        if (!$badgePemula) {

            $target = $targetAktif;
            $progress = 0;

            $sisaDonasi = $targetAktif;
            $sisaDonasiCount = $minimalDonasiSahabat;

            $level = 'Belum Menjadi Donatur';
        } elseif (!$badgeAktif) {

            $target = $targetAktif;

            $progress = min(
                round(($totalDonasi / $targetAktif) * 100),
                100
            );

            $sisaDonasi = max(
                $targetAktif - $totalDonasi,
                0
            );

            $sisaDonasiCount = max(
                $minimalDonasiSahabat - $jumlahDonasi,
                0
            );

            $level = 'Menuju Donatur Aktif';
        } elseif (!$badgeEmas) {

            $target = $targetEmas;

            $progress = min(
                round(($totalDonasi / $targetEmas) * 100),
                100
            );

            $sisaDonasi = max(
                $targetEmas - $totalDonasi,
                0
            );

            $sisaDonasiCount = max(
                $minimalDonasiSahabat - $jumlahDonasi,
                0
            );

            $level = 'Menuju Donatur Emas';
        } elseif (!$badgeSahabat) {

            $target = $targetSahabat;

            $progressNominal = min(
                ($totalDonasi / $targetSahabat) * 100,
                100
            );

            $progressJumlah = min(
                ($jumlahDonasi / $minimalDonasiSahabat) * 100,
                100
            );

            $progress = round(
                ($progressNominal + $progressJumlah) / 2
            );

            $sisaDonasi = max(
                $targetSahabat - $totalDonasi,
                0
            );

            $sisaDonasiCount = max(
                $minimalDonasiSahabat - $jumlahDonasi,
                0
            );

            $level = 'Menuju Sahabat Masjid';
        } else {

            $target = $targetSahabat;
            $progress = 100;

            $sisaDonasi = 0;
            $sisaDonasiCount = 0;

            $level = 'Sahabat Masjid';
        }

        $google2fa = new Google2FA();

        $secret = null;
        $qrCode = null;

        if (!$user->two_factor_secret) {

            $secret = $google2fa->generateSecretKey();

            $user->update([
                'two_factor_secret' => encrypt($secret),
            ]);
        } else {

            $secret = decrypt($user->two_factor_secret);
        }

        $qrCode = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );

        return view(
            'home.profile.index',
            compact(
                'user',
                'totalDonasi',
                'jumlahDonasi',
                'badgePemula',
                'badgeAktif',
                'badgeEmas',
                'badgeSahabat',
                'target',
                'progress',
                'level',
                'sisaDonasi',
                'sisaDonasiCount',
                'secret',
                'masjid',
                'qrCode'
            )
        );
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
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
            'password' => 'required|confirmed|min:8',
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

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {

            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ]);
        }

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Akun berhasil dihapus.'
        );
    }
}
