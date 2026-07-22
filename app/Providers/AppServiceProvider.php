<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        RedirectIfAuthenticated::redirectUsing(function () {

            if (!Auth::check()) {
                return route('home');
            }

            return Auth::user()->role === 'admin'
                ? route('admin.dashboard')
                : route('user.home');
        });
    }
}