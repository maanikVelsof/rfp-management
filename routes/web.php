<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Middleware
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\VendorMiddleware;

// Admin Controllers
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\CategoryController;

// Vendor Controllers
use App\Http\Controllers\Vendor\IndexController as VendorIndexController;

// Auth Controllers
use App\Http\Controllers\Auth\VendorRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the admin routes for the rfp_management_system.
 */

Route::middleware(['auth' , AdminMiddleware::class])
->prefix('admin')
->name('admin.')
->group(function(){
    Route::get('/dashboard', [AdminIndexController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
});


/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @use_of_code: Created the vendor routes for the rfp_management_system.
 */
Route::middleware(['auth' , VendorMiddleware::class])
->prefix('vendor')
->name('vendor.')
->group(function(){
    Route::get('/dashboard', [VendorIndexController::class, 'index'])->name('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('vendor/register', [VendorRegisterController::class, 'showRegistrationForm'])
        ->name('vendor.register');
    Route::post('vendor/register', [VendorRegisterController::class, 'register']);
});
require __DIR__.'/auth.php';
