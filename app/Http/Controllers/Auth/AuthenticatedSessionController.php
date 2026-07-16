<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\ActivityHelper;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        ActivityHelper::log(
            'Login',
            Auth::user()->name . ' berhasil login.',
            'fa-right-to-bracket',
            'emerald'
        );

        $user = Auth::user();

        // Simpan waktu login terakhir
        $user->last_login_at = now();
        $user->save();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        ActivityHelper::log(
            'Logout',
            Auth::user()->name . ' keluar dari sistem.',
            'fa-right-from-bracket',
            'slate'
        );

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('logout', 'Anda berhasil keluar dari sistem.');
    }
}
