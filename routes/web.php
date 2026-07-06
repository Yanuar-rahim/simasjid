<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\DonasiController;


Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/kegiatan/detail/{slug}', [HomeController::class, 'showKegiatan'])
    ->name('kegiatan.detail');

Route::get('/pengumuman/detail/{slug}', [HomeController::class, 'showPengumuman'])
    ->name('pengumuman.detail');
/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {

        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Kegiatan
    Route::resource('kegiatan', KegiatanController::class);

    // CRUD Pengumuman
    Route::resource('pengumuman', PengumumanController::class);

    // CRUD Donasi
    Route::resource('donasi', DonasiController::class)
        ->except(['create', 'store']);
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
