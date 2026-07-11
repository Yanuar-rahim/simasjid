<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;

use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengumumanController;

/*
|--------------------------------------------------------------------------
| Landing Page Guest
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Detail Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/kegiatan/detail/{slug}', [HomeController::class, 'showKegiatan'])
    ->name('kegiatan.detail');

Route::get('/pengumuman/detail/{slug}', [HomeController::class, 'showPengumuman'])
    ->name('pengumuman.detail');

/*
|--------------------------------------------------------------------------
| User (Setelah Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Beranda
    Route::get('/home', [HomeController::class, 'userHome'])
        ->name('user.home');

    // =====================
    // DONASI
    // =====================

    Route::get('/home/donasi', [HomeController::class, 'donasi'])
        ->name('user.donasi');

    Route::post('/home/donasi', [DonasiController::class, 'store'])
        ->name('user.donasi.store');

    // =====================
    // RIWAYAT DONASI
    // =====================

    Route::get('/home/riwayat', [HomeController::class, 'riwayat'])
        ->name('user.riwayat');

    // =====================
    // KEGIATAN
    // =====================

    Route::get('/home/kegiatan', [HomeController::class, 'kegiatan'])
        ->name('user.kegiatan');

    // =====================
    // PENGUMUMAN
    // =====================

    Route::get('/home/pengumuman', [HomeController::class, 'pengumuman'])
        ->name('user.pengumuman');

    // =====================
    // PROFILE
    // =====================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('kegiatan', KegiatanController::class);

    Route::resource('pengumuman', PengumumanController::class);

    Route::resource('donasi', AdminDonasiController::class)
        ->except(['create', 'store']);
});

require __DIR__ . '/auth.php';
