<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonasiController;

use App\Http\Controllers\Home\ProfileController as UserProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MasjidController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::prefix('kegiatan')
    ->name('public.kegiatan.')
    ->group(function () {

        Route::get('/', [HomeController::class, 'publicKegiatan'])
            ->name('index');

        Route::get('/detail/{slug}', [HomeController::class, 'showKegiatan'])
            ->name('detail');
    });

Route::prefix('pengumuman')
    ->name('public.pengumuman.')
    ->group(function () {

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

Route::get(
    '/home/donasi/notification',
    [DonasiController::class, 'notificationPage']
)->name('user.donasi.notification.page');

Route::post(
    '/home/donasi/notification',
    [DonasiController::class, 'notification']
)
    ->withoutMiddleware([
        VerifyCsrfToken::class
    ])
    ->name('user.donasi.notification');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/home', [HomeController::class, 'userHome'])
        ->name('user.home');

    /*
    |--------------------------------------------------------------------------
    | Donasi
    |--------------------------------------------------------------------------
    */

    Route::prefix('home/donasi')->group(function () {

        Route::get('/', [HomeController::class, 'donasi'])
            ->name('user.donasi');

        Route::post('/', [DonasiController::class, 'store'])
            ->name('user.donasi.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Riwayat
    |--------------------------------------------------------------------------
    */

    Route::get('/home/riwayat', [HomeController::class, 'riwayat'])
        ->name('user.riwayat');

    /*
    |--------------------------------------------------------------------------
    | Keuangan
    |--------------------------------------------------------------------------
    */

    Route::get('/home/keuangan', [HomeController::class, 'keuangan'])
        ->name('user.keuangan');

    /*
    |--------------------------------------------------------------------------
    | Kegiatan
    |--------------------------------------------------------------------------
    */

    Route::prefix('home/kegiatan')->group(function () {

        Route::get('/', [HomeController::class, 'kegiatan'])
            ->name('user.kegiatan');

        Route::get('/{slug}', [HomeController::class, 'userShowKegiatan'])
            ->name('user.kegiatan.detail');
    });

    /*
    |--------------------------------------------------------------------------
    | Pengumuman
    |--------------------------------------------------------------------------
    */

    Route::prefix('home/pengumuman')->group(function () {

        Route::get('/', [HomeController::class, 'pengumuman'])
            ->name('user.pengumuman');

        Route::get('/{slug}', [HomeController::class, 'userShowPengumuman'])
            ->name('user.pengumuman.detail');
    });

    /*
    |--------------------------------------------------------------------------
    | Galeri
    |--------------------------------------------------------------------------
    */

    Route::prefix('home/galeri')->group(function () {

        Route::get('/', [HomeController::class, 'galeri'])
            ->name('user.galeri');

        Route::get('/{id}', [HomeController::class, 'detailGaleri'])
            ->name('user.galeri.detail');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::prefix('home/profile')->group(function () {

        Route::get('/', [UserProfileController::class, 'index'])
            ->name('user.profile');

        Route::get('/edit', [UserProfileController::class, 'edit'])
            ->name('user.profile.edit');

        Route::patch('/update', [UserProfileController::class, 'update'])
            ->name('user.profile.update');

        Route::patch('/password', [UserProfileController::class, 'updatePassword'])
            ->name('user.profile.password');

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

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'index']
    )->name('admin.dashboard');

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
        ->except([
            'create',
            'store'
        ]);

    /*
    |--------------------------------------------------------------------------
    | Keuangan
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin/keuangan')->group(function () {

        Route::get(
            '/',
            [KeuanganController::class, 'index']
        )->name('keuangan.index');

        Route::resource(
            'pemasukan',
            PemasukanController::class
        );

        Route::resource(
            'pengeluaran',
            PengeluaranController::class
        );

    });

    /*
    |--------------------------------------------------------------------------
    | Profil Masjid
    |--------------------------------------------------------------------------
    */

    Route::prefix('masjid')->group(function () {

        Route::get(
            '/',
            [MasjidController::class, 'index']
        )->name('masjid.index');

        Route::post(
            '/',
            [MasjidController::class, 'save']
        )->name('masjid.save');

    });

    /*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/

Route::prefix('admin/laporan')
    ->name('laporan.')
    ->controller(LaporanController::class)
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard Laporan
        |--------------------------------------------------------------------------
        */

        Route::get('/', 'index')
            ->name('index');

        /*
        |--------------------------------------------------------------------------
        | Laporan Keuangan
        |--------------------------------------------------------------------------
        */

        Route::get('/keuangan', 'keuangan')
            ->name('keuangan');

        Route::get('/keuangan/export/excel', 'exportExcel')
            ->name('keuangan.excel');

        Route::get('/keuangan/export/pdf', 'exportPdf')
            ->name('keuangan.pdf');

        /*
        |--------------------------------------------------------------------------
        | Laporan Donasi
        |--------------------------------------------------------------------------
        */

        Route::get('/donasi', 'donasi')
            ->name('donasi');

        Route::get('/donasi/export/excel', 'exportDonasiExcel')
            ->name('donasi.excel');

        Route::get('/donasi/export/pdf', 'exportDonasiPdf')
            ->name('donasi.pdf');

        /*
        |--------------------------------------------------------------------------
        | Laporan Pengguna
        |--------------------------------------------------------------------------
        */

        Route::get('/user', 'pengguna')
            ->name('user');

        Route::get('/user/export/excel', 'exportPenggunaExcel')
            ->name('pengguna.excel');

        Route::get('/user/export/pdf', 'exportPenggunaPdf')
            ->name('pengguna.pdf');

        /*
        |--------------------------------------------------------------------------
        | Laporan Kegiatan
        |--------------------------------------------------------------------------
        */

        Route::get('/kegiatan', 'kegiatan')
            ->name('kegiatan');

        Route::get('/kegiatan/export/excel', 'exportKegiatanExcel')
            ->name('kegiatan.excel');

        Route::get('/kegiatan/export/pdf', 'exportKegiatanPdf')
            ->name('kegiatan.pdf');


        
    });

});

require __DIR__.'/auth.php';