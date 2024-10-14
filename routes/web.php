<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Rute untuk halaman utama (misal, halaman daftar tugas atau landing page)
Route::get('/', function () {
    return view('auth.login'); // Halaman utama (sesuaikan view yang kamu inginkan)
});

// Rute untuk menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses login
Route::post('/login', [LoginController::class, 'login']);

// Rute untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk menampilkan form registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Rute untuk memproses registrasi
Route::post('/register', [RegisterController::class, 'register']);

// Rute untuk halaman dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard'); // Tampilkan halaman dashboard setelah login
})->middleware('auth')->name('dashboard');

Route::post('/register', [RegisterController::class, 'register'])->name('register');