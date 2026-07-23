<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\Google2FA as Google2FAQRCode;

class TwoFactorController extends Controller
{
    /**
     * Halaman verifikasi TOTP setelah login
     */
    public function index()
    {
        // Jika belum login, kembali ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('admin.security.verify-2fa');
    }

    /**
     * Halaman pengaturan Two Factor Authentication
     */
    public function settings()
    {
        $user = Auth::user();

        $google2fa = new Google2FAQRCode();

        // Generate secret jika belum ada
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
            'admin.profile.security',
            compact(
                'user',
                'secret',
                'qrCode'
            )
        );
    }

    /**
     * Mengaktifkan Two Factor Authentication
     */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = Auth::user();

        $google2fa = new Google2FA();

        $secret = decrypt($user->two_factor_secret);

        if (
            !$google2fa->verifyKey(
                $secret,
                $request->code
            )
        ) {

            return back()->withErrors([
                'code' => 'Kode autentikasi tidak valid.',
            ]);
        }

        $user->update([
            'two_factor_confirmed_at' => now(),
        ]);

        return back()->with(
            'success',
            'Two-Factor Authentication berhasil diaktifkan.'
        );
    }

    /**
     * Menonaktifkan Two Factor Authentication
     */
    public function disable()
    {
        $user = Auth::user();

        $user->update([
            'two_factor_secret' => null,
            'two_factor_confirmed_at' => null,
            'two_factor_recovery_codes' => null,
        ]);

        session()->forget('2fa_verified');

        return back()->with(
            'success',
            'Two-Factor Authentication berhasil dinonaktifkan.'
        );
    }

    /**
     * Verifikasi kode TOTP ketika login
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = Auth::user();

        if (
            !$user->two_factor_secret ||
            !$user->two_factor_confirmed_at
        ) {
            return redirect()->route(
                $user->role === 'admin'
                    ? 'admin.dashboard'
                    : 'user.home'
            );
        }

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            decrypt($user->two_factor_secret),
            $request->code
        );

        if (!$valid) {

            return back()->withErrors([
                'code' => 'Kode autentikasi tidak valid.',
            ]);
        }

        session([
            '2fa_verified' => true,
        ]);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.home');
    }
}
