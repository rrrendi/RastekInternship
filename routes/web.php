<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicantManagementController;
use App\Http\Controllers\Admin\AnnouncementController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/daftar', [ApplicantController::class, 'create'])->name('applicant.register');
Route::post('/daftar', [ApplicantController::class, 'store'])->name('applicant.store');
Route::get('/cek-status', function() {
    return view('applicant.check-status');
})->name('applicant.check-status');
Route::post('/cek-status', [ApplicantController::class, 'checkStatus'])->name('applicant.status');

// Dashboard route - PENTING untuk redirect setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Redirect berdasarkan role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        // User biasa redirect ke home
        return redirect()->route('home');
    })->name('dashboard');
});

// Admin Routes (Protected with auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Applicant Management
    Route::get('/applicants', [ApplicantManagementController::class, 'index'])->name('applicants.index');
    Route::get('/applicants/{applicant}', [ApplicantManagementController::class, 'show'])->name('applicants.show');
    Route::patch('/applicants/{applicant}/status', [ApplicantManagementController::class, 'updateStatus'])->name('applicants.update-status');
    Route::delete('/applicants/{applicant}', [ApplicantManagementController::class, 'destroy'])->name('applicants.destroy');
    
    // Announcements
    Route::resource('announcements', AnnouncementController::class);
});

// Auth routes - Laravel Breeze/Jetstream
require __DIR__.'/auth.php';