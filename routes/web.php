<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SellerProfileController;

Route::get('/', [ProductController::class, 'index'])->name('home');

// Detail produk (sementara belum dipakai, nanti untuk show)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('stores', StoreController::class);
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/checkout/{product}', [CheckoutController::class, 'start'])->name('checkout.start');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout/{product}', [CheckoutController::class, 'start'])->name('checkout.start');
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

Route::middleware(['auth']) ->prefix('seller') ->name('seller.') ->group(function () {
    Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [SellerProfileController::class, 'updateStore'])->name('profile.update');
    Route::post('/bank-accounts', [SellerProfileController::class, 'storeBank'])->name('bank.store');
    Route::put('/bank-accounts/{withdrawal}', [SellerProfileController::class, 'updateBank'])->name('bank.update');
    Route::delete('/bank-accounts/{withdrawal}', [SellerProfileController::class, 'destroyBank'])->name('bank.destroy');
});

require __DIR__ . '/auth.php';
