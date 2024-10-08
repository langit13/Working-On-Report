<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/supplier', [ProdukController::class, 'supplier'])->name('supplier');

Route::get('/produk/create', [ProdukController::class, 'create'])->name('supplier.create');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('supplier.store');

Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('supplier.edit');
Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('supplier.update');

Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('supplier.destroy');

Route::get('/admin/produk', [AdminController::class, 'admin'])->name('admin.produk');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:pelanggan'])->name('dashboard');

Route::get('/admin/dashboard', [App\Http\Controllers\UserController::class, 'user'])->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admin');


// Route untuk menampilkan form tambah user
Route::get('/admin/user/create', [App\Http\Controllers\UserController::class, 'create'])
    ->middleware(['auth', 'verified', 'rolemanager:admin'])
    ->name('admin.create');

// Route untuk menyimpan user baru
Route::post('/admin/user', [App\Http\Controllers\UserController::class, 'store'])
    ->middleware(['auth', 'verified', 'rolemanager:admin'])
    ->name('admin.store');

// Route untuk menampilkan form edit user
Route::get('/admin/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.edit');

// Route untuk update user setelah form edit disubmit
Route::put('/admin/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.update');

// Route lainnya jika belum ada
Route::delete('/admin/user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.destroy');



Route::get('/supplier/dashboard', function () {
    return view('supplier.supplier');
})->middleware(['auth', 'verified','rolemanager:supplier'])->name('supplier');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route untuk menampilkan halaman checkout
Route::get('/checkout/{id}', [TransactionController::class, 'checkout'])->name('transactions.checkout');

// Route untuk memproses transaksi
Route::post('/transactions/process', [TransactionController::class, 'processTransaction'])->name('transactions.process');


Route::get('/checkout/success', function() {
    dd(session()->all()); // Tambahkan ini untuk debugging
    return view('transactions.success');
})->name('transactions.success');


Route::get('/orders', [TransactionController::class, 'orders'])->name('transactions.orders');



require __DIR__.'/auth.php';
