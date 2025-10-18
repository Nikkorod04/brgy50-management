<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-brgy50');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Citizen CRUD routes
    Route::resource('citizens', CitizenController::class);
    Route::get('/citizens-export/pdf', [CitizenController::class, 'exportPdf'])->name('citizens.export-pdf');
    Route::get('/citizens/{citizen}/download-profile-picture', [CitizenController::class, 'downloadProfilePicture'])->name('citizens.download-profile-picture');
    Route::get('/citizens/{citizen}/download-national-id', [CitizenController::class, 'downloadNationalIdPhoto'])->name('citizens.download-national-id');

    // Category management routes
    Route::resource('categories', CategoryController::class);
});

require __DIR__.'/auth.php';
