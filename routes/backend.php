<?php

use App\Http\Controllers\Backend\BackendOrderController;
use App\Http\Controllers\Backend\BackendOrderDetailController;
use App\Http\Controllers\Backend\BackendProductController;
use App\Http\Controllers\Backend\BackendProductDetailController;
use App\Http\Controllers\Backend\BackendRoleController;
use App\Http\Controllers\Backend\BackendUserController;
use App\Http\Controllers\Backend\BackendAuthenticationController;
use App\Http\Controllers\Backend\BackendHomeController;
use App\Http\Controllers\Backend\BackendCategoryController;
use App\Http\Controllers\Backend\BackendBrandController;
use App\Http\Controllers\Backend\BackendDashboardController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/admin/login', [BackendAuthenticationController::class, 'index'])
    ->name('backend_auth.index');
Route::post('/admin/login', [BackendAuthenticationController::class, 'login'])
    ->name('backend_auth.login');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    // Logout
    Route::post('/logout', [BackendAuthenticationController::class, 'logout'])
        ->name('backend_auth.logout');

    // // Home
    Route::get('/', BackendHomeController::class)
        ->name('backend.home');

    // Dashboard
    Route::get('/dashboard', [BackendDashboardController::class, 'index'])
        ->name('backend_dashboard.index');
    Route::post('/dashboard/filter', [BackendDashboardController::class, 'filter'])
        ->name('backend_dashboard.filter');

    // User
    Route::prefix('users')->group(function () {
        Route::get('/', [BackendUserController::class, 'index'])
            ->name('backend_user.index');
        Route::get('/create', [BackendUserController::class, 'create'])
            ->name('backend_user.create');
        Route::post('/', [BackendUserController::class, 'store'])
            ->name('backend_user.store');
        Route::get('/search', [BackendUserController::class, 'search'])
            ->name('backend_user.search');
        Route::get('/{id}', [BackendUserController::class, 'show'])
            ->name('backend_user.show');
        Route::get('/{id}/edit', [BackendUserController::class, 'edit'])
            ->name('backend_user.edit');
        Route::put('/{id}', [BackendUserController::class, 'update'])
            ->name('backend_user.update');
        Route::delete('/{id}', [BackendUserController::class, 'destroy'])
            ->name('backend_user.destroy');
    });

    // Role
    Route::prefix('roles')->group(function () {
        Route::get('/', [BackendRoleController::class, 'index'])
            ->name('backend_role.index');
        Route::get('/create', [BackendRoleController::class, 'create'])
            ->name('backend_role.create');
        Route::post('/', [BackendRoleController::class, 'store'])
            ->name('backend_role.store');
        Route::get('/{id}', [BackendRoleController::class, 'show'])
            ->name('backend_role.show');
        Route::get('/{id}/edit', [BackendRoleController::class, 'edit'])
            ->name('backend_role.edit');
        Route::put('/{id}', [BackendRoleController::class, 'update'])
            ->name('backend_role.update');
        Route::delete('/{id}', [BackendRoleController::class, 'destroy'])
            ->name('backend_role.destroy');
    });

    // Product
    Route::prefix('products')->group(function () {
        Route::get('/', [BackendProductController::class, 'index'])
            ->name('backend_product.index');
        Route::get('/create', [BackendProductController::class, 'create'])
            ->name('backend_product.create');
        Route::post('/store', [BackendProductController::class, 'store'])
            ->name('backend_product.store');
        Route::get('/search', [BackendProductController::class, 'search'])
            ->name('backend_product.search');
        Route::get('/{id}', [BackendProductController::class, 'show'])
            ->name('backend_product.show');
        Route::get('/{id}/edit', [BackendProductController::class, 'edit'])
            ->name('backend_product.edit');
        Route::put('/{id}', [BackendProductController::class, 'update'])
            ->name('backend_product.update');
        Route::delete('/{id}', [BackendProductController::class, 'destroy'])
            ->name('backend_product.destroy');
    });

    //Product detail
    Route::prefix('productdetail')->group(function () {
        Route::get('/', [BackendProductDetailController::class, 'index'])
            ->name('backend_productdetail.index');
        Route::get('/create', [BackendProductDetailController::class, 'create'])
            ->name('backend_productdetail.create');
        Route::post('/{id}', [BackendProductDetailController::class, 'store'])
            ->name('backend_productdetail.store');
        Route::get('/{id}', [BackendProductDetailController::class, 'show'])
            ->name('backend_productdetail.show');
        Route::get('/{id}/edit', [BackendProductDetailController::class, 'edit'])
            ->name('backend_productdetail.edit');
        Route::put('/{id}', [BackendProductDetailController::class, 'update'])
            ->name('backend_productdetail.update');
        Route::delete('/{id}', [BackendProductDetailController::class, 'destroy'])
            ->name('backend_productdetail.destroy');
    });

    // Category
    Route::prefix('categories')->group(function () {
        Route::get('/', [BackendCategoryController::class, 'index'])
            ->name('backend_category.index');
        Route::get('/create', [BackendCategoryController::class, 'create'])
            ->name('backend_category.create');
        Route::post('/', [BackendCategoryController::class, 'store'])
            ->name('backend_category.store');
        Route::get('/search', [BackendCategoryController::class, 'search'])
            ->name('backend_category.search');
        Route::get('/{id}', [BackendCategoryController::class, 'show'])
            ->name('backend_category.show');
        Route::get('/{id}/edit', [BackendCategoryController::class, 'edit'])
            ->name('backend_category.edit');
        Route::put('/{id}', [BackendCategoryController::class, 'update'])
            ->name('backend_category.update');
        Route::delete('/{id}', [BackendCategoryController::class, 'destroy'])
            ->name('backend_category.destroy');
    });
    // Brand
    Route::prefix('brands')->group(function () {
        Route::get('/', [BackendBrandController::class, 'index'])
            ->name('backend_brand.index');
        Route::get('/create', [BackendBrandController::class, 'create'])
            ->name('backend_brand.create');
        Route::post('/', [BackendBrandController::class, 'store'])
            ->name('backend_brand.store');
        Route::get('/search', [BackendBrandController::class, 'search'])
            ->name('backend_brand.search');
        Route::get('/{id}', [BackendBrandController::class, 'show'])
            ->name('backend_brand.show');
        Route::get('/{id}/edit', [BackendBrandController::class, 'edit'])
            ->name('backend_brand.edit');
        Route::put('/{id}', [BackendBrandController::class, 'update'])
            ->name('backend_brand.update');
        Route::delete('/{id}', [BackendBrandController::class, 'destroy'])
            ->name('backend_brand.destroy');
    });

    // Order
    Route::prefix('orders')->group(function () {
        Route::get('/', [BackendOrderController::class, 'index'])
            ->name('backend_order.index');
        Route::get('/create', [BackendOrderController::class, 'create'])
            ->name('backend_order.create');
        Route::post('/', [BackendOrderController::class, 'store'])
            ->name('backend_order.store');
        Route::get('/search', [BackendOrderController::class, 'search'])
            ->name('backend_order.search');
        Route::get('/{id}', [BackendOrderController::class, 'show'])
            ->name('backend_order.show');
        Route::get('/{id}/edit', [BackendOrderController::class, 'edit'])
            ->name('backend_order.edit');
        Route::put('/{id}', [BackendOrderController::class, 'update'])
            ->name('backend_order.update');
        Route::delete('/{id}', [BackendOrderController::class, 'destroy'])
            ->name('backend_order.destroy');
        Route::get('/status/{id}', [BackendOrderController::class, 'filter'])
            ->name('backend_order.filter');
    });

    // Order detail
    Route::prefix('orderdetail')->group(function () {
        Route::get('/', [BackendOrderDetailController::class, 'index'])
            ->name('backend_orderdetail.index');
        Route::get('/create', [BackendOrderDetailController::class, 'create'])
            ->name('backend_orderdetail.create');
        Route::post('/', [BackendOrderDetailController::class, 'store'])
            ->name('backend_orderdetail.store');
        Route::get('/{id}', [BackendOrderDetailController::class, 'show'])
            ->name('backend_orderdetail.show');
        Route::get('/{id}/edit', [BackendOrderDetailController::class, 'edit'])
            ->name('backend_orderdetail.edit');
        Route::put('/{id}', [BackendOrderDetailController::class, 'update'])
            ->name('backend_orderdetail.update');
        Route::delete('/{id}', [BackendOrderDetailController::class, 'destroy'])
            ->name('backend_orderdetail.destroy');
    });
});
