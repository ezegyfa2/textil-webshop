<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/fetch', [UserController::class, 'fetch'])->name('user.fetch');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');

    Route::get('/checkouts', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkouts/fetch', [CheckoutController::class, 'fetch'])->name('checkout.fetch');
    Route::get('/checkouts/{checkout}', [CheckoutController::class, 'show'])->name('checkout.show');

    Route::get('/cart/fetch-items', [CartController::class, 'fetchItems'])->name('cart.fetch-items');
});
