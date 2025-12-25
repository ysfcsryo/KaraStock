<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AUTH ROUTES ---
// Login page
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes - harus login dulu
Route::middleware('auth')->group(function () {
    
    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/delete-photo', [AuthController::class, 'deleteProfilePhoto'])->name('profile.deletePhoto');
    
    // --- 1. HALAMAN UTAMA & UPLOAD ---
    // Menampilkan form upload
    Route::get('/', [ProductController::class, 'index'])->name('home');

    // Memproses file CSV yang diupload
    Route::post('/proses-csv', [ProductController::class, 'uploadCsv'])->name('upload.csv');


    // --- 2. HASIL ANALISA ---
    // Menampilkan tabel hasil prediksi dengan Filter File
    Route::get('/hasil-analisa', [ProductController::class, 'hasilAnalisa'])->name('hasil.analisa');

    // Menampilkan Visualisasi Tree & Entropy (Detail per file)
    Route::get('/proses-file', [ProductController::class, 'prosesFile'])->name('proses.file');


    // --- 3. EVALUASI MODEL ---
    // Training data & Testing akurasi (Confusion Matrix)
    Route::get('/evaluasi', [ProductController::class, 'evaluasi'])->name('evaluasi');


    // --- 4. RIWAYAT (HISTORY) ---
    // Menampilkan halaman riwayat
    Route::get('/riwayat', [ProductController::class, 'riwayat'])->name('riwayat.index');

    // Hapus satu file
    Route::delete('/riwayat/hapus-file', [ProductController::class, 'hapusByFile'])->name('riwayat.hapusByFile');

    // Hapus semua data
    Route::delete('/riwayat/hapus-semua', [ProductController::class, 'hapusSemua'])->name('riwayat.hapusSemua');
    
    // --- 5. ADMIN PANEL (Super Admin Only) ---
    Route::middleware('check.super.admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserManagementController::class);
        Route::post('users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('users.reset-password');
    });
});

// --- Opsional: Testing ---
// Route::get('/debug/simulate-upload', [ProductController::class, 'simulateUploadTest']);