<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/stores/verification', [AdminController::class, 'storeVerification'])->name('admin.stores.verification');
    Route::post('/stores/{store}/verify', [AdminController::class, 'verifyStore'])->name('admin.stores.verify');
    Route::post('/stores/{store}/reject', [AdminController::class, 'rejectStore'])->name('admin.stores.reject'); // Opsional

    Route::get('/users-stores', [AdminController::class, 'userAndStoreManagement'])->name('admin.users-stores.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update'); // Menggunakan PUT untuk UPDATE
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy'); // Menggunakan DELETE untuk HAPUS
});

require __DIR__.'/auth.php';
