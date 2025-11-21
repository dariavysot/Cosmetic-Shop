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
use App\Http\Controllers\StoreController;

Route::get('/', [CosmeticController::class, 'publicCatalog'])->name('home');

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


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

});

Route::get('/cosmetics', [CosmeticController::class, 'index'])->name('cosmetics.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/cosmetics/create', [CosmeticController::class, 'create'])->name('cosmetics.create');
    Route::post('/cosmetics', [CosmeticController::class, 'store'])->name('cosmetics.store');
    Route::get('/cosmetics/{cosmetic}/edit', [CosmeticController::class, 'edit'])->name('cosmetics.edit');
    Route::put('/cosmetics/{cosmetic}', [CosmeticController::class, 'update'])->name('cosmetics.update');
    Route::delete('/cosmetics/{cosmetic}', [CosmeticController::class, 'destroy'])->name('cosmetics.destroy');
});


Route::prefix('inventory')->group(function () {

    Route::get('/', [InventoryController::class, 'index'])
        ->name('inventory.index');

    Route::get('/add', [InventoryController::class, 'addForm'])
        ->name('inventory.addForm');

    Route::post('/add', [InventoryController::class, 'add'])
        ->name('inventory.add');
});


// Stores
Route::resource('stores', StoreController::class);
Route::get('/stores/{store}/inventory', [StoreController::class, 'inventory'])
     ->name('stores.inventory');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
});


Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create');

    // Лише адмін може змінювати статус
    Route::middleware('admin')->group(function () {
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
    });
});
