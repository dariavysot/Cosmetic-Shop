<?php

use Illuminate\Support\Facades\Route;

// --- AUTH ---
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// --- SHOP ---
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CosmeticController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
})->name('home');

// =======================
// АВТОРИЗАЦІЯ
// =======================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');

