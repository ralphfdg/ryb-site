<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

// Public Catalog
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{car}', [CatalogController::class, 'show'])->name('catalog.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // We will add customer purchase history routes here later
});

// Protected Admin Portal Routes
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // 2. Inventory Management (CRUD)
    // This single line automatically generates routes for index, create, store, edit, update, destroy
    Route::resource('cars', App\Http\Controllers\Admin\CarController::class);
    
    // Inventory (Cars) Placeholder Routes
    Route::get('/inventory', function() { return 'Inventory View'; })->name('cars.index');
    
    // Sales Placeholder Routes
    Route::get('/sales', function() { return 'Sales View'; })->name('sales.index');
    
    // Customers Placeholder Routes
    Route::get('/customers', function() { return 'Customers View'; })->name('customers.index');
    
    // Inquiries Placeholder Routes
    Route::get('/inquiries', function() { return 'Inquiries View'; })->name('inquiries.index');
});

// Customer Routes (Authenticated Users)
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () { return view('customer.dashboard'); })->name('dashboard');
});

// Laravel Breeze auth routes (Login/Register)
require __DIR__.'/auth.php';