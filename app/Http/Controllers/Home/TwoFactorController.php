<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    public function enable(Request $request)
    {
        $request->validate([
            'code' => ['required','digits:6'],
        ]);

        $user = Auth::user();

        $google2fa = new Google2FA();

        $secret = decrypt($user->two_factor_secret);

        if (!$google2fa->verifyKey($secret,$request->code)) {

            return back()->withErrors([
                'code' => 'Kode OTP tidak valid.'
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

    public function index()
    {
        return view('home.security.verify-2fa');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required','digits:6'],
        ]);

        $user = Auth::user();

        $google2fa = new Google2FA();

        if (!$google2fa->verifyKey(
            decrypt($user->two_factor_secret),
            $request->code
        )) {

            return back()->withErrors([
                'code' => 'Kode autentikasi tidak valid.'
            ]);

        }

        session([
            '2fa_verified' => true
        ]);

        return redirect()->route('user.home');
    }
}