<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
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
        Route::patch('/dashboard/customer/update/{id}', 'update')->name('customer.update');
        Route::get('/dashboard/customer/user_courses/{id}', 'user_courses')->name('customer.user_courses');
    }
)->middleware(['auth', 'verified']);

Route::controller(TeacherController::class)->group(
    function () {
        Route::get('/dashboard/teacher', 'index')->name('teacher.index');
        Route::patch('/dashboard/teacher/update/{id}', 'update')->name('teacher.update');
        Route::get('/dashboard/teacher/teacher_courses/{id}', 'teacher_courses')->name('teacher.teacher_courses');
    }
)->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('dashboard/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('dashboard/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
