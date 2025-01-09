<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified', 'role:admin|manager|staff']);

// breeze Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Transaction Route 
Route::middleware(['auth', 'verified'])->group(function () {
    // Create route
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('transaction', [TransactionController::class, 'store'])->name('transaction.store');
    // Edit route
    Route::get('transaction/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('transaction/update/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    // View route
    Route::get('transaction/view/{id}', [TransactionController::class, 'view'])->name('transaction.view');
    // Delete route
    Route::delete('transaction/delete/{id}', [TransactionController::class, 'delete'])->name('transaction.delete');
});

// Users Route
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
    // create
    Route::get('/create', [UsersController::class, 'create'])->name('create')->middleware(['auth', 'verified']);
    Route::post('/store', [UsersController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
    // edit
    Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('edit')->middleware(['auth', 'verified']); 
    Route::put('/{id}', [UsersController::class, 'update'])->name('update')->middleware(['auth', 'verified']); 
    // delete
    Route::delete('/{id}', [UsersController::class, 'delete'])->name('delete')->middleware(['auth', 'verified']);
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';


// percobaan spatie langsung di route
// Route::get('admin', function () {
//     return '<h1>Hello Admin</h1>';
// })->middleware(['auth', 'verified', 'role:admin']);

// Route::get('manager', function () {
//     return '<h1>Hello Manager</h1>';
// })->middleware(['auth', 'verified', 'role:manager|admin']);

// Route::get('staff', function () {
//     return '<h1>Hello Staff</h1>';
// })->middleware(['auth', 'verified', 'role:staff|admin']);

