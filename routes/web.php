<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/home', [SiteController::class, 'home'])->name('site.home');
Route::get('/home/product/{product}', [SiteController::class, 'product'])->name('site.product');
Route::get('/home/cart', [SiteController::class, 'cart'])->name('site.cart');
Route::get('/home/name', [SiteController::class, 'name'])->name('site.name');
Route::get('/home/confirmation', [SiteController::class, 'confirmation'])->name('site.confirmation');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
