<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/fetch', [UserController::class, 'fetch'])->name('user.fetch');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/fetch', [ProductController::class, 'fetch'])->name('product.fetch');
    Route::get('/products/search-category', [ProductController::class, 'searchCategory'])
        ->name('product.search-category');
    Route::get('/products/search-fabric-property', [ProductController::class, 'searchFabricProperty'])
        ->name('product.search-fabric-property');
    Route::get('/products/search-cut-property', [ProductController::class, 'searchCutProperty'])
        ->name('product.search-cut-property');
    Route::get('/products/search-brand', [ProductController::class, 'searchBrand'])
        ->name('product.search-brand');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
        
    Route::get('/products/{productType}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/products/{productType}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/products/{productType}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/products/{productType}', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/products/upload-image', [ProductController::class, 'uploadImage'])
        ->name('product.upload-image');
    Route::delete('/products/delete-image/{productImage}', [ProductController::class, 'deleteImage'])
        ->name('product.delete-image');

    Route::get('/product-categories', [ProductCategoryController::class, 'index'])->name('product-category.index');
    Route::get('/product-categories/fetch', [ProductCategoryController::class, 'fetch'])->name('product-category.fetch');
    Route::get('/product-categories/create', [ProductCategoryController::class, 'create'])->name('product-category.create');
    Route::post('/product-categories', [ProductCategoryController::class, 'store'])->name('product-category.store');
    Route::put('/product-categories/{productCategory}', [ProductCategoryController::class, 'update'])
        ->name('product-category.update');
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoryController::class, 'edit'])
        ->name('product-category.edit');
    Route::delete('/product-categories/{productCategory}', [ProductCategoryController::class, 'delete'])
        ->name('product-category.delete');
    Route::post('/product-categories/upload-image', [ProductCategoryController::class, 'uploadImage'])
        ->name('product-category.upload-image');
    Route::delete('/product-categories/delete-image/{image}', [ProductCategoryController::class, 'deleteImage'])
        ->name('product-category.delete-image');

    Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brands/fetch', [BrandController::class, 'fetch'])->name('brand.fetch');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brand.store');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])
        ->name('brand.update');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])
        ->name('brand.edit');
    Route::delete('/brands/{brand}', [BrandController::class, 'delete'])
        ->name('brand.delete');
    Route::post('/brands/upload-image', [BrandController::class, 'uploadImage'])
        ->name('brand.upload-image');
    Route::delete('/brands/delete-image/{image}', [BrandController::class, 'deleteImage'])
        ->name('brand.delete-image');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blogs/fetch', [BlogController::class, 'fetch'])->name('blog.fetch');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])
        ->name('blog.update');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])
        ->name('blog.edit');
    Route::delete('/blogs/{blog}', [BlogController::class, 'delete'])
        ->name('blog.delete');
    Route::post('/blogs/upload-image', [BlogController::class, 'uploadImage'])
        ->name('blog.upload-image');
    Route::delete('/blogs/delete-image/{image}', [BlogController::class, 'deleteImage'])
        ->name('blog.delete-image');
        
    Route::get('/checkouts', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkouts/fetch', [CheckoutController::class, 'fetch'])->name('checkout.fetch');
    Route::get('/checkouts/{checkout}', [CheckoutController::class, 'show'])->name('checkout.show');

    Route::get('/cart/fetch-items', [CartController::class, 'fetchItems'])->name('cart.fetch-items');
});
