<?php

use App\Http\Controllers\KitchenController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::loginUsingId(1);

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/home', [SiteController::class, 'home'])->name('site.home');
Route::get('/home/product/{product}', [SiteController::class, 'product'])->name('site.product');
Route::get('/home/cart', [SiteController::class, 'cart'])->name('site.cart');
Route::get('/home/name', [SiteController::class, 'name'])->name('site.name');
Route::get('/home/confirmation', [SiteController::class, 'confirmation'])->name('site.confirmation');
Route::post('/home/order', [SiteController::class, 'order'])->name('site.order');

Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
Route::put('/order-items/{item}/update-status', [KitchenController::class, 'updateItemStatus']);
Route::put('/order/{order}/status', [KitchenController::class, 'updateOrderStatus']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
