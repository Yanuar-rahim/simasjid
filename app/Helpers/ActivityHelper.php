<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityHelper
{
    public static function log($aktivitas, $deskripsi, $icon = 'fa-circle-info', $color = 'emerald')
    {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'role'       => Auth::check() ? Auth::user()->role : null,
            'aktivitas'  => $aktivitas,
            'deskripsi'  => $deskripsi,
            'icon'       => $icon,
            'color'      => $color,
        ]);
    }
}
