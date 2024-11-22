<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::controller(AdminController::class)->group(
    function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    }
)->middleware(['auth', 'verified']);


Route::controller(CustomerController::class)->group(
    function () {
        Route::get('/dashboard/customer', 'index')->name('customer.index');
        Route::get('/dashboard/customer/create', 'create')->name('customer.create');
        Route::post('/dashboard/customer', 'store')->name('customer.store');
        Route::get('/dashboard/customer/{id}', 'show')->name('customer.show');
        Route::get('/dashboard/customer/{id}/edit', 'edit')->name('customer.edit');
        Route::patch('/dashboard/customer/update/{id}', 'update')->name('customer.update');
        Route::delete('/dashboard/customer/{id}', 'destroy')->name('customer.destroy');
    }
)->middleware(['auth', 'verified']);




Route::middleware('auth')->group(function () {
    Route::get('dashboard/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('dashboard/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
