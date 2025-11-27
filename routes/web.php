<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\BangunanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
// use App\Models\Barang; ini dihapus
use Illuminate\Support\Facades\Route;

// Arahkan root ke halaman login supaya saat menjalankan server langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// dashboard + resource routes — hanya untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Dashboard statistics
        $totalAssets = \App\Models\Barang::count();

        // totals by resource: tanah, bangunan, ruangan, barang
        $totalTanah = \App\Models\Tanah::count();
        $totalBangunan = \App\Models\Bangunan::count();
        $totalRuangan = \App\Models\Ruangan::count();
        $totalBarang = $totalAssets; // alias for clarity

        // define keywords for maintenance and broken statuses (case-insensitive)
        $maintenanceKeywords = ['maintenance', 'perbaikan', 'service', 'repair'];
        $brokenKeywords = ['rusak', 'broken', 'damage', 'damaged'];

        $maintenanceAssets = 0;
        $brokenAssets = 0;

        // build queries that check kondisi against possible keywords
        foreach ($maintenanceKeywords as $kw) {
            $maintenanceAssets += \App\Models\Barang::whereRaw('LOWER(kondisi) like ?', ["%{$kw}%"])->count();
        }

        foreach ($brokenKeywords as $kw) {
            $brokenAssets += \App\Models\Barang::whereRaw('LOWER(kondisi) like ?', ["%{$kw}%"])->count();
        }

        // Avoid double-counting (if kondisi contains both words) — cap at total
        if ($maintenanceAssets + $brokenAssets > $totalAssets) {
            // crude de-dup: pick unique ids matching either
            $allIds = \App\Models\Barang::where(function($q) use ($maintenanceKeywords, $brokenKeywords) {
                foreach (array_merge($maintenanceKeywords, $brokenKeywords) as $kw) {
                    $q->orWhereRaw('LOWER(kondisi) like ?', ["%{$kw}%"]);
                }
            })->pluck('id')->unique();
            // recompute counts using unique matching ids and filter by keywords separately
            $maintenanceAssets = \App\Models\Barang::whereIn('id', $allIds)
                ->where(function($q) use ($maintenanceKeywords) {
                    foreach ($maintenanceKeywords as $kw) {
                        $q->orWhereRaw('LOWER(kondisi) like ?', ["%{$kw}%"]);
                    }
                })->count();

            $brokenAssets = \App\Models\Barang::whereIn('id', $allIds)
                ->where(function($q) use ($brokenKeywords) {
                    foreach ($brokenKeywords as $kw) {
                        $q->orWhereRaw('LOWER(kondisi) like ?', ["%{$kw}%"]);
                    }
                })->count();
        }

        $activeAssets = max(0, $totalAssets - $maintenanceAssets - $brokenAssets);

        // Recent activities
        $recentActivities = \App\Models\Activity::with('user')->latest()->take(10)->get();

        return view('dashboard', compact(
            'totalAssets', 'activeAssets', 'maintenanceAssets', 'brokenAssets', 'recentActivities',
            'totalTanah', 'totalBangunan', 'totalRuangan', 'totalBarang'
        ));
    })->name('dashboard');

    // Tanah - read routes public to authenticated users, write routes only for admin
    Route::get('/tanah', [TanahController::class, 'index'])->name('tanah.index');

    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/tanah/create', [TanahController::class, 'create'])->name('tanah.create');
        Route::post('/tanah', [TanahController::class, 'store'])->name('tanah.store');
        Route::get('/tanah/{id}/edit', [TanahController::class, 'edit'])->name('tanah.edit');
        Route::put('/tanah/{id}', [TanahController::class, 'update'])->name('tanah.update');
        Route::delete('/tanah/{id}', [TanahController::class, 'destroy'])->name('tanah.destroy');
    });

    // Bangunan
    Route::get('/bangunan', [BangunanController::class, 'index'])->name('bangunan.index');
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/bangunan/create', [BangunanController::class, 'create'])->name('bangunan.create');
        Route::post('/bangunan', [BangunanController::class, 'store'])->name('bangunan.store');
        Route::get('/bangunan/{id}/edit', [BangunanController::class, 'edit'])->name('bangunan.edit');
        Route::put('/bangunan/{id}', [BangunanController::class, 'update'])->name('bangunan.update');
        Route::delete('/bangunan/{id}', [BangunanController::class, 'destroy'])->name('bangunan.destroy');
    });

    // Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
        Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
        Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
    });

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

        // Admin - User management
        Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
            Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
            Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
            Route::get('/users/{id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        });
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/barang', function () {
//     return view('data', [
//         'title' => 'Barang',
//         'items' => Barang::all(),
//     ]);
// });

// (moved into the middleware group above)
