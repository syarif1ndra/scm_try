<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Hapus route duplikat berikut ini
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->group(callback: function () {
    Route::resource('pengiriman', PengirimanController::class)->names([
        'index' => 'admin.pengiriman.index', // Menetapkan nama rute untuk index
        'create' => 'admin.pengiriman.create',
        'store' => 'admin.pengiriman.store',
        'edit' => 'admin.pengiriman.edit',
        'update' => 'admin.pengiriman.update',
        'destroy' => 'admin.pengiriman.destroy'
    ]);
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pengiriman', [PengirimanController::class, 'index'])->name('admin.pengiriman');
    Route::get('/admin/pengiriman/create', [PengirimanController::class, 'create'])->name('admin.pengiriman.create');
    Route::post('admin/pengiriman/store', [PengirimanController::class,'store'])->name('admin.pengiriman.store');
    Route::get('/admin/pengiriman/{id}/edit', [PengirimanController::class, 'edit'])->name('admin.pengiriman.edit');
Route::put('/admin/pengiriman/{id}', [PengirimanController::class, 'update'])->name('admin.pengiriman.update');
Route::delete('/admin/pengiriman/{id}', [PengirimanController::class, 'destroy'])->name('admin.pengiriman.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/pengiriman', [PengirimanController::class, 'indexForUser'])->name('pengiriman.index');
});
require __DIR__.'/auth.php';
