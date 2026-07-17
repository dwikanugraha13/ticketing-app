<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

// Static info pages (linked from the footer)
Route::get('/info/{slug}', [InfoController::class, 'show'])->name('info.show');

// Event routes
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Category routes (admin)
Route::prefix('admin')->name('categories.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

// Lokasi routes (admin)
Route::prefix('admin')->name('admin.lokasis.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/lokasis', [\App\Http\Controllers\LokasiController::class, 'index'])->name('index');
    Route::post('/lokasis', [\App\Http\Controllers\LokasiController::class, 'store'])->name('store');
    Route::put('/lokasis/{id}', [\App\Http\Controllers\LokasiController::class, 'update'])->name('update');
    Route::delete('/lokasis/{id}', [\App\Http\Controllers\LokasiController::class, 'destroy'])->name('destroy');
});

// Event management routes (admin)
Route::prefix('admin')->name('admin.events.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('index');
    Route::get('/events/create', [EventController::class, 'create'])->name('create');
    Route::post('/events', [EventController::class, 'store'])->name('store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('destroy');
    Route::delete('/events/{event}/image', [EventController::class, 'deleteImage'])->name('deleteImage');
    Route::post('/events/{event}/clone', [EventController::class, 'clone'])->name('clone');
});

// Admin Transactions
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
});

// Profile routes (admin & user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Transaksi / Payment
    Route::post('/checkout', [\App\Http\Controllers\TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'history'])->name('transactions.history');
    Route::get('/payment/{order}', [\App\Http\Controllers\TransactionController::class, 'payment'])->name('transactions.payment');
    Route::post('/payment/{order}/process', [\App\Http\Controllers\TransactionController::class, 'processPayment'])->name('transactions.process');
});

require __DIR__.'/auth.php';
