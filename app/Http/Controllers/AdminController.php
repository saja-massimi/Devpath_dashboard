<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Courses;
use App\Models\Teacher;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {

            $totalTransactionAmount = Transaction::sum('amount');
            $totalUsers = User::where('role', 'user')->count();
            $totalCourses = Courses::count();
            $totalTeachers = Teacher::count();

            return view('dashboard.home', [
                'totalTransactionAmount' => $totalTransactionAmount,
                'totalUsers' => $totalUsers,
                'totalCourses' => $totalCourses,
                'totalTeachers' => $totalTeachers

            ]);
        } else {
            Auth::logout();
            return redirect('/');
        }
    }
}
