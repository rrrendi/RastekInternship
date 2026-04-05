<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\pendaftarManagementController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/daftar', [PendaftarController::class, 'create'])->name('pendaftar.register');
Route::post('/daftar', [PendaftarController::class, 'store'])->name('pendaftar.store');
Route::get('/cek-status', function() {
    return view('pendaftar.check-status');
})->name('pendaftar.check-status');
Route::post('/cek-status', [PendaftarController::class, 'checkStatus'])->name('pendaftar.status');

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
    
    // pendaftar Management
    Route::get('/pendaftars', [pendaftarManagementController::class, 'index'])->name('pendaftars.index');
    Route::get('/pendaftars/export/data', [pendaftarManagementController::class, 'export'])->name('pendaftars.export');
    Route::get('/pendaftars/{pendaftar}', [pendaftarManagementController::class, 'show'])->name('pendaftars.show');
    Route::patch('/pendaftars/{pendaftar}/status', [pendaftarManagementController::class, 'updateStatus'])->name('pendaftars.update-status');
    Route::delete('/pendaftars/{pendaftar}', [pendaftarManagementController::class, 'destroy'])->name('pendaftars.destroy');
    
    // Announcements
    Route::resource('announcements', AnnouncementController::class);

    // User Management (TAMBAHKAN INI)
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::get('/change-password', [UserManagementController::class, 'showChangePassword'])->name('change-password');
    Route::post('/change-password', [UserManagementController::class, 'changePassword'])->name('update-password');
});

// Auth routes - Laravel Breeze/Jetstream
require __DIR__.'/auth.php';