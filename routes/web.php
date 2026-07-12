<?php

use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

Route::prefix('kegiatan')->name('public.kegiatan.')->group(function () {

    Route::get('/', [HomeController::class, 'publicKegiatan'])
        ->name('index');

    Route::get('/detail/{slug}', [HomeController::class, 'showKegiatan'])
        ->name('detail');
});

Route::prefix('pengumuman')->name('public.pengumuman.')->group(function () {

    Route::get('/', [HomeController::class, 'publicPengumuman'])
        ->name('index');

    Route::get('/detail/{slug}', [HomeController::class, 'showPengumuman'])
        ->name('detail');
});

/*
|--------------------------------------------------------------------------
| Midtrans Notification
|--------------------------------------------------------------------------
*/

Route::get('/home/donasi/notification', [DonasiController::class, 'notificationPage'])
    ->name('user.donasi.notification.page');

Route::post('/home/donasi/notification', [DonasiController::class, 'notification'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('user.donasi.notification');

/*
|--------------------------------------------------------------------------
| USER LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'userHome'])
        ->name('user.home');

    Route::get('/home/donasi', [HomeController::class, 'donasi'])
        ->name('user.donasi');

    Route::post('/home/donasi', [DonasiController::class, 'store'])
        ->name('user.donasi.store');

    Route::get('/home/riwayat', [HomeController::class, 'riwayat'])
        ->name('user.riwayat');

    Route::get('/home/kegiatan', [HomeController::class, 'kegiatan'])
        ->name('user.kegiatan');

    Route::get('/home/kegiatan/{slug}', [HomeController::class, 'userShowKegiatan'])
        ->name('user.kegiatan.detail');

    Route::get('/home/pengumuman', [HomeController::class, 'pengumuman'])
        ->name('user.pengumuman');

    Route::get('/home/pengumuman/{slug}', [HomeController::class, 'userShowPengumuman'])
        ->name('user.pengumuman.detail');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    /*
    |-----------------------------
    | Kegiatan Admin
    |-----------------------------
    */

    Route::resource('kegiatan', KegiatanController::class);

    /*
    |-----------------------------
    | Pengumuman Admin
    |-----------------------------
    */

    Route::resource('pengumuman', PengumumanController::class);

    /*
    |-----------------------------
    | Donasi Admin
    |-----------------------------
    */

    Route::resource('donasi', AdminDonasiController::class)
        ->except(['create', 'store']);
});

require __DIR__.'/auth.php';