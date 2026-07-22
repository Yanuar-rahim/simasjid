<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.home');
        }

        $request->fulfill();

        if ($request->user()->role == 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('verified', true);
        }

        return redirect()->route('user.home')
            ->with('verified', true);
    }
}
