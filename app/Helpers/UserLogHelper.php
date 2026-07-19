<?php

namespace App\Helpers;

use App\Models\UserLog;
use Illuminate\Http\Request;

class UserLogHelper
{
    public static function store(string $activity, Request $request): void
    {
        if (!auth()->check()) {
            return;
        }

        UserLog::create([
            'user_id'    => auth()->id(),
            'activity'   => $activity,
            'ip_address' => $request->ip(),
            'device'     => self::device($request->userAgent()),
        ]);
    }

    protected static function device(?string $userAgent): string
    {
        $ua = strtolower($userAgent ?? '');

        // Browser
        $browser = 'Browser';

        if (str_contains($ua, 'edg')) {
            $browser = 'Microsoft Edge';
        } elseif (str_contains($ua, 'chrome')) {
            $browser = 'Google Chrome';
        } elseif (str_contains($ua, 'firefox')) {
            $browser = 'Mozilla Firefox';
        } elseif (str_contains($ua, 'safari') && !str_contains($ua, 'chrome')) {
            $browser = 'Safari';
        } elseif (str_contains($ua, 'opera')) {
            $browser = 'Opera';
        }

        // OS
        $os = 'Unknown OS';

        if (str_contains($ua, 'windows nt 10')) {
            $os = 'Windows';
        } elseif (str_contains($ua, 'windows nt 11')) {
            $os = 'Windows 11';
        } elseif (str_contains($ua, 'android')) {
            $os = 'Android';
        } elseif (str_contains($ua, 'iphone')) {
            $os = 'iPhone';
        } elseif (str_contains($ua, 'ipad')) {
            $os = 'iPad';
        } elseif (str_contains($ua, 'mac os')) {
            $os = 'macOS';
        } elseif (str_contains($ua, 'linux')) {
            $os = 'Linux';
        }

        return "{$os} • {$browser}";
    }
}
