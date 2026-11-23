<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PmbController;
use App\Http\Controllers\DocumentVerificationController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes - PMB Universitas Klabat
|--------------------------------------------------------------------------
*/

// Fallback for public storage files (works across all Windows/OneDrive environments)
Route::get('/storage/{path}', function ($path) {
    if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return \Illuminate\Support\Facades\Storage::disk('public')->response($path);
})->where('path', '.*')->name('storage.file');

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Unified Authentication (Single Login Page)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth Authentication
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Applicant Flow (Protected by role:applicant)
Route::middleware(['auth', 'role:applicant'])->prefix('pmb')->name('pmb.')->group(function () {
    // Step 1: Biodata & Program Studi
    Route::get('/biodata', [PmbController::class, 'biodata'])->name('biodata');
    Route::post('/biodata', [PmbController::class, 'storeBiodata'])->name('biodata.store');

    // Step 2: Unggah & AI Verifier Dokumen
    Route::get('/dokumen', [PmbController::class, 'dokumen'])->name('dokumen');
    Route::post('/dokumen/verify', [DocumentVerificationController::class, 'verify'])->name('dokumen.verify');
    Route::post('/dokumen/remove/{type}', [DocumentVerificationController::class, 'remove'])->name('dokumen.remove');
    Route::post('/finalisasi', [PmbController::class, 'finalize'])->name('finalisasi');

    // Step 3: Finalisasi & Kartu Bukti Pendaftaran
    Route::get('/bukti-pendaftaran', [PmbController::class, 'bukti'])->name('bukti');
    Route::post('/resend-card-email', [PmbController::class, 'resendCardEmail'])->name('resend_card_email');
});

// Admin Panitia PMB Flow (Protected by role:admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/applicant/{id}/detail', [AdminController::class, 'getApplicantDetail'])->name('applicant.detail');
    Route::post('/applicant/{id}/approve', [AdminController::class, 'approve'])->name('applicant.approve');
    Route::post('/applicant/{id}/reject', [AdminController::class, 'reject'])->name('applicant.reject');
});
