<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonasiController;

use App\Http\Controllers\Home\ProfileController as UserProfileController;
use App\Http\Controllers\Home\TwoFactorController as UserTwoFactorController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MasjidController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\TwoFactorController as AdminTwoFactorController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\LaporanController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('kegiatan')->name('public.kegiatan.')->group(function () {
    Route::get('/', [HomeController::class, 'publicKegiatan'])->name('index');
    Route::get('/detail/{slug}', [HomeController::class, 'showKegiatan'])->name('detail');
});

Route::prefix('pengumuman')->name('public.pengumuman.')->group(function () {
    Route::get('/', [HomeController::class, 'publicPengumuman'])->name('index');
    Route::get('/detail/{slug}', [HomeController::class, 'showPengumuman'])->name('detail');
});

Route::get('/home/donasi/notification', [DonasiController::class, 'notificationPage'])
    ->name('user.donasi.notification.page');

Route::post('/home/donasi/notification', [DonasiController::class, 'notification'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('user.donasi.notification');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/user/2fa', [UserTwoFactorController::class, 'index'])
        ->name('user.2fa.index');

    Route::post('/user/2fa', [UserTwoFactorController::class, 'verify'])
        ->name('user.2fa.verify');

    Route::get('/home', [HomeController::class, 'userHome'])
        ->name('user.home');

    Route::prefix('home/donasi')->group(function () {
        Route::get('/', [HomeController::class, 'donasi'])->name('user.donasi');
        Route::post('/', [DonasiController::class, 'store'])->name('user.donasi.store');
    });

    Route::get('/home/riwayat', [HomeController::class, 'riwayat'])
        ->name('user.riwayat');

    Route::get('/home/keuangan', [HomeController::class, 'keuangan'])
        ->name('user.keuangan');

    Route::prefix('home/kegiatan')->group(function () {
        Route::get('/', [HomeController::class, 'kegiatan'])->name('user.kegiatan');
        Route::get('/{slug}', [HomeController::class, 'userShowKegiatan'])->name('user.kegiatan.detail');
    });

    Route::prefix('home/pengumuman')->group(function () {
        Route::get('/', [HomeController::class, 'pengumuman'])->name('user.pengumuman');
        Route::get('/{slug}', [HomeController::class, 'userShowPengumuman'])->name('user.pengumuman.detail');
    });

    Route::prefix('home/galeri')->group(function () {
        Route::get('/', [HomeController::class, 'galeri'])->name('user.galeri');
        Route::get('/{id}', [HomeController::class, 'detailGaleri'])->name('user.galeri.detail');
    });

    Route::post('/home/profile/2fa/enable', [UserTwoFactorController::class, 'enable'])
        ->name('user.2fa.enable');

    Route::post('/home/profile/2fa/disable', [UserTwoFactorController::class, 'disable'])
        ->name('user.2fa.disable');

    Route::prefix('home/profile')->group(function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('user.profile');
        Route::get('/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
        Route::patch('/update', [UserProfileController::class, 'update'])->name('user.profile.update');
        Route::patch('/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password');
        Route::delete('/destroy', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/2fa', [AdminTwoFactorController::class, 'index'])
        ->name('admin.2fa.index');

    Route::post('/admin/2fa', [AdminTwoFactorController::class, 'verify'])
        ->name('admin.2fa.verify');
});

Route::middleware(['auth', 'admin', 'verified', '2fa'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('users', UserController::class);

    Route::resource('kegiatan', KegiatanController::class);

    Route::resource('pengumuman', PengumumanController::class);

    Route::resource('galeri', GaleriController::class);

    Route::resource('donasi', AdminDonasiController::class)
        ->except(['create', 'store']);

    Route::prefix('admin/keuangan')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::resource('pemasukan', PemasukanController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
    });

    Route::prefix('masjid')->group(function () {
        Route::get('/', [MasjidController::class, 'index'])->name('masjid.index');
        Route::post('/', [MasjidController::class, 'save'])->name('masjid.save');
    });

    Route::prefix('admin/laporan')->name('laporan.')->controller(LaporanController::class)->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/keuangan', 'keuangan')->name('keuangan');
        Route::get('/keuangan/export/excel', 'exportExcel')->name('keuangan.excel');
        Route::get('/keuangan/export/pdf', 'exportPdf')->name('keuangan.pdf');

        Route::get('/donasi', 'donasi')->name('donasi');
        Route::get('/donasi/export/excel', 'exportDonasiExcel')->name('donasi.excel');
        Route::get('/donasi/export/pdf', 'exportDonasiPdf')->name('donasi.pdf');

        Route::get('/user', 'pengguna')->name('user');
        Route::get('/user/export/excel', 'exportPenggunaExcel')->name('pengguna.excel');
        Route::get('/user/export/pdf', 'exportPenggunaPdf')->name('pengguna.pdf');

        Route::get('/kegiatan', 'kegiatan')->name('kegiatan');
        Route::get('/kegiatan/export/excel', 'exportKegiatanExcel')->name('kegiatan.excel');
        Route::get('/kegiatan/export/pdf', 'exportKegiatanPdf')->name('kegiatan.pdf');
    });

    Route::get('/admin/profile', [AdminProfileController::class, 'index'])
        ->name('admin.profile');

    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])
        ->name('admin.profile.edit');

    Route::patch('/admin/profile/update', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');

    Route::get('/admin/profile/password', [AdminProfileController::class, 'password'])
        ->name('admin.profile.password');

    Route::patch('/admin/profile/password', [AdminProfileController::class, 'updatePassword'])
        ->name('admin.profile.password.update');

    Route::delete('/admin/profile/delete-photo', [AdminProfileController::class, 'deletePhoto'])
        ->name('admin.profile.deletePhoto');

    Route::get('/admin/profile/security', [AdminTwoFactorController::class, 'settings'])
        ->name('admin.profile.security');

    Route::post('/admin/profile/security/enable', [AdminTwoFactorController::class, 'enable'])
        ->name('admin.2fa.enable');

    Route::post('/admin/profile/security/disable', [AdminTwoFactorController::class, 'disable'])
        ->name('admin.2fa.disable');
});

require __DIR__ . '/auth.php';