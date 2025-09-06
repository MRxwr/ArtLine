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
