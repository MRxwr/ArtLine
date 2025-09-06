<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SuperDashboardController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Access Page
Route::get('/admin/access', function () {
    return view('admin-access');
})->name('admin.access');

// Simple Admin Routes
Route::get('/admin/superdashboard', [SuperDashboardController::class, 'index'])->name('admin.superdashboard');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
