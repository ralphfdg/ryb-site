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
use App\Http\Controllers\Admin\SaleController;
// use App\Http\Controllers\Admin\InquiryController; // Uncomment when created

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
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

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
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Inquiries
    Route::post('/inquiries', [ContactController::class, 'storeInquiry'])->name('inquiries.store');

    // Appointments (Dashboard Prefix)
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    });
});


/*
|--------------------------------------------------------------------------
| Admin Portal Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inventory Management (Generates index, create, store, edit, update, destroy)
    Route::resource('cars', CarController::class);
    
    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    
    // Sales & Inquiries (Ready for their actual controllers)
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    
    // Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');

    // The Admin Appointment Hub Routes
    Route::get('/appointments', [App\Http\Controllers\Admin\AppointmentController::class, 'index'])->name('appointments.index');
    
    // Route to approve an appointment (Phase 2, Step 2)
    Route::patch('/appointments/{appointment}/approve', [App\Http\Controllers\Admin\AppointmentController::class, 'approve'])->name('appointments.approve');
    
    // Route to update viewing notes, price, and commit status (Phase 2, Steps 3 & 4)
    Route::put('/appointments/{appointment}', [App\Http\Controllers\Admin\AppointmentController::class, 'update'])->name('appointments.update');
    
    // Route to finalize the sale (Phase 2, Step 5)
    Route::post('/sales', [App\Http\Controllers\Admin\SaleController::class, 'store'])->name('sales.store');
});

// Laravel Breeze auth routes
require __DIR__.'/auth.php';