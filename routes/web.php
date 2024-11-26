<?php

use App\Http\Controllers\KitchenController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::loginUsingId(1);

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/home', [SiteController::class, 'home'])->name('site.home');
Route::get('/home/products', [SiteController::class, 'products'])->name('site.products');
Route::get('/home/product/{product}', [SiteController::class, 'product'])->name('site.product');
Route::get('/home/cart', [SiteController::class, 'cart'])->name('site.cart');
// Route::get('/home/name', [SiteController::class, 'name'])->name('site.name');
Route::get('/home/confirmation', [SiteController::class, 'confirmation'])->name('site.confirmation');
Route::post('/home/order', [SiteController::class, 'order'])->name('site.order');


Route::middleware('auth')->group(function () {
    Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
    Route::get('/orders', [KitchenController::class, 'orders'])->name('kitchen.orders');
    Route::put('/order-items/{item}/update-status', [KitchenController::class, 'updateItemStatus']);
    Route::put('/order/{order}/status', [KitchenController::class, 'updateOrderStatus']);
    
    Route::resource('/table', TableController::class);
    Route::get('/tables/qrcode', [TableController::class, 'qrcode'])->name('table.qrcode');
    Route::get('/tables/orders', [TableController::class, 'orders'])->name('table.orders');


    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
});


require __DIR__.'/auth.php';
