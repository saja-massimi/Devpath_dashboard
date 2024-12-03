<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


/*************************** Admin Routes ***********************************/

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

Route::controller(ContactusController::class)->group(
    function () {
        Route::get('/dashboard/contactUs', 'index')->name('contactus.index');
        Route::get('/dashboard/contactUs/edit/{id}', 'edit')->name('contactus.edit');
        Route::patch('/dashboard/contactUs/update/{id}', 'update')->name('contactus.update');
        Route::delete('/dashboard/contactUs/{id}', 'destroy')->name('contactus.destroy');
    }
)->middleware(['auth', 'verified']);

Route::controller(TeacherController::class)->group(
    function () {
        Route::get('/dashboard/teacher', 'index')->name('teacher.index');
        Route::patch('/dashboard/teacher/update/{id}', 'update')->name('teacher.update');
        Route::get('/dashboard/teacher/teacher_courses/{id}', 'teacher_courses')->name('teacher.teacher_courses');
    }
)->middleware(['auth', 'verified']);

Route::controller(CategoriesController::class)->group(
    function () {
        Route::get('/dashboard/categories', 'index')->name('categories.index');
        Route::get('/dashboard/createCategory', 'create')->name('categories.create');
        Route::post('/dashboard/categories', 'store')->name('categories.store');
        Route::patch('/dashboard/categories/update/{id}', 'update')->name('categories.update');
        Route::delete('/dashboard/categories/{id}', 'destroy')->name('categories.destroy');
    }
)->middleware(['auth', 'verified']);

Route::controller(TransactionController::class)->group(
    function () {
        Route::get('/dashboard/transactions', 'index')->name('transactions.index');
        Route::get('/dashboard/transactions/edit/{id}', 'edit')->name('transactions.edit');
        Route::patch('/dashboard/transactions/update/{id}', 'update')->name('transactions.update');
        Route::get('/dashboard/transactions/create', 'create')->name('transactions.create');
        Route::post('/dashboard/transactions', 'store')->name('transactions.store');
        Route::delete('/dashboard/transactions/{id}', 'destroy')->name('transactions.destroy');
    }
)->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('dashboard/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('dashboard/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'authorize'])->group(
    function () {

        Route::get('/dashboard/courses', [CoursesController::class, 'index'])->name('courses.index');
        Route::get('/dashboard/courses/edit/{id}', [CoursesController::class, 'edit'])->name('courses.edit');
        Route::patch('/dashboard/courses/update/{id}', [CoursesController::class, 'update'])->name('courses.update');
        Route::delete('/dashboard/courses/{id}', [CoursesController::class, 'destroy'])->name('courses.destroy');
    }
);

/*************************** User Routes ***********************************/

Route::middleware('auth')->group(function () {
    Route::get('dashboard/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('dashboard/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});












require __DIR__ . '/auth.php';
