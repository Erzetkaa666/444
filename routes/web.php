<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanahController;
// use App\Models\Barang; ini dihapus
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['name' => 'Jane Doe']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/barang', function () {
//     return view('data', [
//         'title' => 'Barang',
//         'items' => Barang::all(),
//     ]);
// });

// Ganti jadi ini!
Route::get('/tanah', [TanahController::class, 'index'])->name('tanah.index');
Route::get('/tanah/create', [TanahController::class, 'create'])->name('tanah.create');
Route::post('/tanah', [TanahController::class, 'store'])->name('tanah.store');
Route::get('/tanah/{id}/edit', [TanahController::class, 'edit'])->name('tanah.edit');
Route::put('/tanah/{id}', [TanahController::class, 'update'])->name('tanah.update');
Route::delete('/tanah/{id}', [TanahController::class, 'destroy'])->name('tanah.destroy');

// Bangunan
use App\Http\Controllers\BangunanController;
Route::get('/bangunan', [BangunanController::class, 'index'])->name('bangunan.index');
Route::get('/bangunan/create', [BangunanController::class, 'create'])->name('bangunan.create');
Route::post('/bangunan', [BangunanController::class, 'store'])->name('bangunan.store');
Route::get('/bangunan/{id}/edit', [BangunanController::class, 'edit'])->name('bangunan.edit');
Route::put('/bangunan/{id}', [BangunanController::class, 'update'])->name('bangunan.update');
Route::delete('/bangunan/{id}', [BangunanController::class, '   destroy'])->name('bangunan.destroy');           

