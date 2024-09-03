<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin:dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin:user.index');
    Route::get('/users/fetch', [UserController::class, 'fetch'])->name('admin:user.fetch');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin:user.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin:user.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin:user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin:user.update');
});
