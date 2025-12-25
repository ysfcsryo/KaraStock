<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

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

// --- Opsional: Testing ---
// Route::get('/debug/simulate-upload', [ProductController::class, 'simulateUploadTest']);