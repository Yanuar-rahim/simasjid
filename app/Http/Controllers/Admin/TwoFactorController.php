<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $qrCode = null;
        $secret = null;

        if ($user->two_factor_secret) {
            $google2fa = new Google2FA();
            $secret = decrypt($user->two_factor_secret);
            $qrCode = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $secret
            );
        }

        return view('admin.profile.security', compact(
            'user',
            'qrCode',
            'secret'
        ));
    }

    public function enable()
    {
        $user = Auth::user();
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();
        $user->update([
            'two_factor_secret' => encrypt($secret),
        ]);

        return redirect()
            ->route('admin.profile.security')
            ->with('success', 'Secret Key berhasil dibuat.');
    }

    public function confirm()
    {
        //
    }

    public function disable()
    {
        $user = Auth::user();

        $user->update([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);

        return back()->with('success', 'Two-Factor Authentication berhasil dinonaktifkan.');
    }
}
