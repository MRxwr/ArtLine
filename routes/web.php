<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SuperDashboardController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Access Page
Route::get('/admin', function () {
    return view('admin-access');
})->name('admin.access');

// Admin Routes
Route::prefix('admin')->group(function () {
    // SuperDashboard Routes (for superadmin)
    Route::prefix('superdashboard')->name('superdashboard.')->group(function () {
        Route::get('/', [SuperDashboardController::class, 'index'])->name('index');
        
        // Stores management
        Route::get('/stores', [SuperDashboardController::class, 'stores'])->name('stores.index');
        Route::get('/stores/create', [SuperDashboardController::class, 'createStore'])->name('stores.create');
        Route::post('/stores', [SuperDashboardController::class, 'storeStore'])->name('stores.store');
        Route::get('/stores/{store}', [SuperDashboardController::class, 'showStore'])->name('stores.show');
        Route::get('/stores/{store}/edit', [SuperDashboardController::class, 'editStore'])->name('stores.edit');
        Route::put('/stores/{store}', [SuperDashboardController::class, 'updateStore'])->name('stores.update');
        Route::delete('/stores/{store}', [SuperDashboardController::class, 'destroyStore'])->name('stores.destroy');
        
        // Users management
        Route::get('/users', [SuperDashboardController::class, 'users'])->name('users.index');
        
        // Soft deleted items
        Route::get('/soft-deleted', [SuperDashboardController::class, 'softDeleted'])->name('soft-deleted.index');
        
        // Audit logs
        Route::get('/audit-logs', [SuperDashboardController::class, 'auditLogs'])->name('audit-logs.index');
        
        // Global data views
        Route::get('/categories', [SuperDashboardController::class, 'categories'])->name('categories.index');
        Route::get('/products', [SuperDashboardController::class, 'products'])->name('products.index');
        Route::get('/vouchers', [SuperDashboardController::class, 'vouchers'])->name('vouchers.index');
    });
    
    // Store Dashboard Routes (for store clients)
    Route::prefix('dashboard/{store}')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        
        // Categories
        Route::get('/categories', [DashboardController::class, 'categories'])->name('categories.index');
        Route::get('/categories/create', [DashboardController::class, 'createCategory'])->name('categories.create');
        Route::post('/categories', [DashboardController::class, 'storeCategory'])->name('categories.store');
        Route::get('/categories/{category}/edit', [DashboardController::class, 'editCategory'])->name('categories.edit');
        Route::put('/categories/{category}', [DashboardController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [DashboardController::class, 'destroyCategory'])->name('categories.destroy');
        
        // Products
        Route::get('/products', [DashboardController::class, 'products'])->name('products.index');
        Route::get('/products/create', [DashboardController::class, 'createProduct'])->name('products.create');
        Route::post('/products', [DashboardController::class, 'storeProduct'])->name('products.store');
        Route::get('/products/{product}/edit', [DashboardController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{product}', [DashboardController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{product}', [DashboardController::class, 'destroyProduct'])->name('products.destroy');
        
        // Banners
        Route::get('/banners', [DashboardController::class, 'banners'])->name('banners.index');
        Route::get('/banners/create', [DashboardController::class, 'createBanner'])->name('banners.create');
        Route::post('/banners', [DashboardController::class, 'storeBanner'])->name('banners.store');
        Route::get('/banners/{banner}/edit', [DashboardController::class, 'editBanner'])->name('banners.edit');
        Route::put('/banners/{banner}', [DashboardController::class, 'updateBanner'])->name('banners.update');
        Route::delete('/banners/{banner}', [DashboardController::class, 'destroyBanner'])->name('banners.destroy');
        
        // Product Options
        Route::get('/product-options', [DashboardController::class, 'productOptions'])->name('product-options.index');
        Route::get('/product-options/create', [DashboardController::class, 'createProductOption'])->name('product-options.create');
        Route::post('/product-options', [DashboardController::class, 'storeProductOption'])->name('product-options.store');
        Route::get('/product-options/{option}/edit', [DashboardController::class, 'editProductOption'])->name('product-options.edit');
        Route::put('/product-options/{option}', [DashboardController::class, 'updateProductOption'])->name('product-options.update');
        Route::delete('/product-options/{option}', [DashboardController::class, 'destroyProductOption'])->name('product-options.destroy');
        
        // Vouchers
        Route::get('/vouchers', [DashboardController::class, 'vouchers'])->name('vouchers.index');
        Route::get('/vouchers/create', [DashboardController::class, 'createVoucher'])->name('vouchers.create');
        Route::post('/vouchers', [DashboardController::class, 'storeVoucher'])->name('vouchers.store');
        Route::get('/vouchers/{voucher}/edit', [DashboardController::class, 'editVoucher'])->name('vouchers.edit');
        Route::put('/vouchers/{voucher}', [DashboardController::class, 'updateVoucher'])->name('vouchers.update');
        Route::delete('/vouchers/{voucher}', [DashboardController::class, 'destroyVoucher'])->name('vouchers.destroy');
        
        // Orders
        Route::get('/orders', [DashboardController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{order}', [DashboardController::class, 'showOrder'])->name('orders.show');
        
        // Employees & Roles
        Route::get('/employees', [DashboardController::class, 'employees'])->name('employees.index');
        Route::get('/roles', [DashboardController::class, 'roles'])->name('roles.index');
        
        // Store Settings
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings.index');
        Route::put('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
    });
});

// Public Admin Routes (direct access)
Route::get('/superdashboard', [SuperDashboardController::class, 'index'])->name('admin.superdashboard');
Route::get('/dashboard/{store}', [DashboardController::class, 'index'])->name('admin.dashboard');
