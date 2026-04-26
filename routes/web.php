<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SaleController;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

// Public Catalog
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{car}', [CatalogController::class, 'show'])->name('catalog.show');

// Admin Routes protected by Auth and Spatie 'Admin' Role
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::resource('cars', CarController::class);
    Route::resource('sales', SaleController::class)->except(['destroy']); 
});

// Customer Routes (Authenticated Users)
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () { return view('customer.dashboard'); })->name('dashboard');
});

// Laravel Breeze auth routes (Login/Register)
require __DIR__.'/auth.php';