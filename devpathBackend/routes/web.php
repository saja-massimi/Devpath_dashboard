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


Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    }
);

Route::middleware('auth', 'authorize')->group(
    function () {
        Route::get('/dashboard/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::patch('/dashboard/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('/dashboard/customer/user_courses/{id}', [CustomerController::class, 'user_courses'])->name('customer.user_courses');
    }
);

Route::middleware('auth', 'authorize')->group(
    function () {
        Route::get('/dashboard/contactUs', [ContactusController::class, 'index'])->name('contactus.index');
        Route::get('/dashboard/contactUs/edit/{id}', [ContactusController::class, 'edit'])->name('contactus.edit');
        Route::patch('/dashboard/contactUs/update/{id}', [ContactusController::class, 'update'])->name('contactus.update');
        Route::delete('/dashboard/contactUs/{id}', [ContactusController::class, 'destroy'])->name('contactus.destroy');
    }
);

Route::middleware('auth', 'authorize')->group(
    function () {
        Route::get('/dashboard/teacher', [TeacherController::class, 'index'])->name('teacher.index');
        Route::patch('/dashboard/teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::get('/dashboard/teacher/teacher_courses/{id}', [TeacherController::class, 'teacher_courses'])->name('teacher.teacher_courses');
    }
);

Route::middleware('auth', 'authorize')->group(
    function () {
        Route::get('/dashboard/categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::get('/dashboard/createCategory', [CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/dashboard/categories', [CategoriesController::class, 'store'])->name('categories.store');
        Route::patch('/dashboard/categories/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/dashboard/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    }
);

Route::middleware('auth', 'authorize')->group(
    function () {
        Route::get('/dashboard/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/dashboard/transactions/edit/{id}', [TransactionController::class, 'edit'])->name('transactions.edit');
        Route::patch('/dashboard/transactions/update/{id}', [TransactionController::class, 'update'])->name('transactions.update');
        Route::get('/dashboard/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/dashboard/transactions', [TransactionController::class, 'store'])->name('transactions.store');
        Route::delete('/dashboard/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    }
);

Route::middleware('auth', 'authorize')->group(function () {
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














require __DIR__ . '/auth.php';
