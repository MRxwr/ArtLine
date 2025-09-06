<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Laravel is working!';
});

// Admin Access Page
Route::get('/admin/access', function () {
    return view('admin-access');
})->name('admin.access');

// Simple Admin Dashboard Routes
Route::get('/admin/superdashboard', function () {
    return '<h1>SuperDashboard</h1><p>This will be the superadmin dashboard.</p><a href="/admin/access">Back to Admin Access</a>';
})->name('admin.superdashboard');

Route::get('/admin/dashboard', function () {
    return '<h1>Store Dashboard</h1><p>This will be the store dashboard.</p><a href="/admin/access">Back to Admin Access</a>';
})->name('admin.dashboard');
