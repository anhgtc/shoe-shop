<?php

use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LocalizationController;
use App\Http\Controllers\Frontend\DistrictController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Contain routes of user interface
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

// // Route change Language
// Route::get('/locale/{locale}', [LocalizationController::class, 'changeLocale'])
//             ->name('locale');

// Product
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');
    Route::get('/search', [ProductController::class, 'search'])
        ->name('products.search');
    Route::get('/{id}', [ProductController::class, 'show'])
        ->name('products.show');
    Route::get('/{id}/classify', [ProductController::class, 'classify'])
        ->name('products.classify');
    Route::get('/filter/brand', [ProductController::class, 'filter'])
        ->name('products.filter');
    Route::get('/size/cách đo và quy đổi', [ProductController::class, 'selectSize'])
        ->name('products.selectsize');
    Route::post('/size', [ProductController::class, 'size']);
    Route::post('/number', [ProductController::class, 'number']);
});

// Cart
Route::prefix('carts')->group(function () {
    Route::get('/', [CartController::class, 'index'])
        ->name('carts.index');
    Route::post('/{id}', [CartController::class, 'store'])
        ->name('carts.store');
    Route::put('/{id}', [CartController::class, 'update'])
        ->name('carts.update');
    Route::delete('/{id}', [CartController::class, 'destroy'])
        ->name('carts.destroy');
});
// Order
Route::prefix('orders')->group(function () {
    Route::get('/create', [OrderController::class, 'create'])
        ->name('orders.create');
    Route::post('/store', [OrderController::class, 'store'])
        ->name('orders.store');
    Route::get('/', [OrderController::class, 'index'])
        ->name('orders.index');
    Route::get('/{id}', [OrderController::class, 'show'])
        ->name('orders.show');
    Route::post('/district', [OrderController::class, 'district']);
    Route::post('/ward', [OrderController::class, 'ward']);
    Route::post('/vnpay', [OrderController::class, 'vnpay'])
        ->name('orders.vnpay');
    Route::get('/status/{id}', [OrderController::class, 'filter'])
        ->name('orders.filter');
});

Route::get('/vnpay-success', [OrderController::class, 'vnpaySuccess'])
        ->name('orders.vnpaySuccess');