<?php

use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasjidController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home\ProfileController as UserProfileController;
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

    Route::get('/home/keuangan', [HomeController::class, 'keuangan'])
        ->name('user.keuangan');

    Route::get('/home/kegiatan', [HomeController::class, 'kegiatan'])
        ->name('user.kegiatan');

    Route::get('/home/kegiatan/{slug}', [HomeController::class, 'userShowKegiatan'])
        ->name('user.kegiatan.detail');

    Route::get('/home/pengumuman', [HomeController::class, 'pengumuman'])
        ->name('user.pengumuman');

    Route::get('/home/pengumuman/{slug}', [HomeController::class, 'userShowPengumuman'])
        ->name('user.pengumuman.detail');

    Route::get('/home/galeri', [HomeController::class, 'galeri'])
        ->name('user.galeri');

    Route::get('/home/galeri/{id}', [HomeController::class, 'detailGaleri'])
        ->name('user.galeri.detail');

    Route::prefix('home/profile')->group(function () {

        // Halaman profil
        Route::get('/', [UserProfileController::class, 'index'])
            ->name('user.profile');

        // Form edit (opsional)
        Route::get('/edit', [UserProfileController::class, 'edit'])
            ->name('user.profile.edit');

        // Update profil
        Route::patch('/update', [UserProfileController::class, 'update'])
            ->name('user.profile.update');

        // Update password
        Route::patch('/password', [UserProfileController::class, 'updatePassword'])
            ->name('user.profile.password');

        // Hapus akun
        Route::delete('/destroy', [UserProfileController::class, 'destroy'])
            ->name('user.profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Manajemen Pengguna
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | Kegiatan
    |--------------------------------------------------------------------------
    */

    Route::resource('kegiatan', KegiatanController::class);

    /*
    |--------------------------------------------------------------------------
    | Pengumuman
    |--------------------------------------------------------------------------
    */

    Route::resource('pengumuman', PengumumanController::class);

    /*
    |--------------------------------------------------------------------------
    | Galeri
    |--------------------------------------------------------------------------
    */

    Route::resource('galeri', GaleriController::class);

    /*
    |--------------------------------------------------------------------------
    | Donasi
    |--------------------------------------------------------------------------
    */

    Route::resource('donasi', AdminDonasiController::class)
        ->except(['create', 'store']);

    /*
    |--------------------------------------------------------------------------
    | Keuangan
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin/keuangan')->group(function () {

        Route::get('/', [KeuanganController::class, 'index'])
            ->name('keuangan.index');

        Route::resource('pemasukan', PemasukanController::class);

        Route::resource('pengeluaran', PengeluaranController::class);
    });

    Route::prefix('masjid')->group(function () {

        Route::get('/', [MasjidController::class, 'index'])
            ->name('masjid.index');

        Route::post('/', [MasjidController::class, 'save'])
            ->name('masjid.save');
    });

    /*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/

    Route::prefix('laporan')
        ->name('laporan.')
        ->controller(\App\Http\Controllers\Admin\LaporanController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');

            Route::get('/keuangan', 'keuangan')
                ->name('keuangan');

            Route::get('/donasi', 'donasi')
                ->name('donasi');

            Route::get('/user', 'user')
                ->name('user');

            Route::get('/kegiatan', 'kegiatan')
                ->name('kegiatan');
        });

    Route::prefix('admin/laporan')->group(function () {

        Route::get('/', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('/keuangan', [LaporanController::class, 'keuangan'])
            ->name('laporan.keuangan');

        Route::get('/keuangan/pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporan.keuangan.pdf');

        Route::get('/keuangan/excel', [LaporanController::class, 'exportExcel'])
            ->name('laporan.keuangan.excel');

        Route::get('/donasi', [LaporanController::class, 'donasi'])
            ->name('laporan.donasi');

        Route::get('/laporan/donasi/export/excel', [LaporanController::class, 'exportDonasiExcel'])
            ->name('laporan.donasi.excel');

        Route::get('/laporan/donasi/export/pdf', [LaporanController::class, 'exportDonasiPdf'])
            ->name('laporan.donasi.pdf');
    });
});

require __DIR__ . '/auth.php';
