<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController; // 1. Import your new CarController

// Front Facing Routes
Route::get('/', function () {
    return view('index');
});
// About route
Route::get('/about', function () {
    return view('about');
});
// Catalog route
Route::get('/catalog', function () {
    return view('catalog');
});
// Contact route
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')
    ;
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('password.request');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->name('password.reset');

Route::get('/profile', function () {
    return view('profile.profile'); 
})->name('profile');

// Admin Routes Group
// 2. Added name('admin.') so all routes inside get the 'admin.' prefix
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // 3. Changed 'admin.dashboard' to just 'dashboard' because the group handles the prefix now
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // 4. Your new Inventory routes! This one line creates index, create, store, edit, update, destroy
    Route::resource('inventory', CarController::class);
});

require __DIR__.'/auth.php';
