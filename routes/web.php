<?php

use App\Http\Controllers\Admin\AdminAppointmentController;
// Public Controllers
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
// Customer Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AppointmentController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\InquiryController as CustomerInquiryController;

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
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'storeGeneral'])->name('contact.store');
    Route::post('/inquiries', [ContactController::class, 'storeVehicle'])->name('inquiries.store');

    // Appointments (Dashboard Prefix)
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::post('/appointments', [AppointmentController::class, 'store'])
            ->name('appointments.store')
            ->middleware('throttle:5,60'); // Allow 5 submissions every 60 minutes per IP/User
        Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
        Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

        Route::get('/inquiries/{inquiry}', [CustomerInquiryController::class, 'show'])->name('inquiries.show');
    });

    // Wishlist Data Endpoints (For Alpine.js)
    Route::get('/wishlist/data', [WishlistController::class, 'getWishlistData'])->name('wishlist.data');
    Route::post('/wishlist/{car}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // User Dashboard View
    Route::get('/dashboard/wishlist', [WishlistController::class, 'index'])->name('dashboard.wishlist.index');
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

        // Approve Appointment
        Route::patch('/{appointment}/approve', [AdminAppointmentController::class, 'approve'])->name('approve');

        // Update Remarks, Negotiated Price, and Commitment Status
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

    // Admin Profile Management
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

});

// Laravel Breeze auth routes
require __DIR__.'/auth.php';
