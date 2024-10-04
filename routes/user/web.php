<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\BlogController;
use App\Http\Middleware\SaveCart;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([SaveCart::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/thank-you', [HomeController::class, 'thankYou'])->name('thank-you');
    
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/fetch', [ProductController::class, 'fetch'])->name('product.fetch');
    Route::get('/products/{productType}', [ProductController::class, 'show'])->name('product.show');
    
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'storeOrder'])->name('cart.store-order');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add-to-cart');
    Route::put('/cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart', [CartController::class, 'removeFromCart'])->name('cart.remove-from-cart');
    Route::get('/cart/fetch-items', [CartController::class, 'fetchItems'])->name('cart.fetch-items');
    
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blogs/fetch', [BlogController::class, 'fetch'])->name('blog.fetch');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blog.show');
});

Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
