<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\BrandController;

// Customer Controllers
use App\Http\Controllers\Customer\AppointmentController;
use App\Http\Controllers\ContactController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/compare', [CatalogController::class, 'compare'])->name('catalog.compare');
Route::get('/catalog/{car}', [CatalogController::class, 'show'])->name('catalog.show');



/*
|--------------------------------------------------------------------------
| Standard Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'storeGeneral'])->name('contact.store');
    Route::post('/inquiries', [ContactController::class, 'storeVehicle'])->name('inquiries.store');

    // Appointments (Dashboard Prefix)
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    });
});


/*
|--------------------------------------------------------------------------
| Admin Portal Routes (Requires 'Admin' Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Analytics Overview
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Catalog Management (Inventory Domain) ---
    // Generates index, create, store, show, edit, update, destroy
    Route::resource('brands', BrandController::class);
    Route::resource('cars', CarController::class);

    // --- Operations Hub (Business Logic Domain) ---
    // Appointment Hub
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [AdminAppointmentController::class, 'index'])->name('index');
        Route::get('/{appointment}', [AdminAppointmentController::class, 'show'])->name('show');
        
        // Phase 2, Step 2: Approve Appointment
        Route::patch('/{appointment}/approve', [AdminAppointmentController::class, 'approve'])->name('approve');
        
        // Phase 2, Steps 3 & 4: Update Remarks, Negotiated Price, and Commitment Status
        Route::put('/{appointment}', [AdminAppointmentController::class, 'update'])->name('update');
    });

    // Inquiry Management
    Route::prefix('inquiries')->name('inquiries.')->group(function () {
        Route::get('/', [InquiryController::class, 'index'])->name('index');
        Route::get('/{inquiry}', [InquiryController::class, 'show'])->name('show');
        Route::patch('/{inquiry}/resolve', [InquiryController::class, 'resolve'])->name('resolve');
    });
    
    // Sales Ledger (Financial Domain)
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('index');
        Route::get('/{sale}', [SaleController::class, 'show'])->name('show');
        Route::post('/', [SaleController::class, 'store'])->name('store');
    });

    // --- Directory ---
    // Customer Directory (View-only protection)
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
    });

});

// Laravel Breeze auth routes
require __DIR__.'/auth.php';