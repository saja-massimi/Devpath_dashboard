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

        if (!Auth::user()) {
            return redirect('/');
        }

        if (Auth::user()->role == 'admin') {

            $totalRevenue = Transaction::selectRaw('DATE_FORMAT(created_at, "%m") as month, SUM(amount) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $months = $totalRevenue->pluck('month')->toArray();            
            $monthNames = [
                '01' => 'Jan',
                '02' => 'Feb',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'Aug',
                '09' => 'Sept',
                '10' => 'Oct',
                '11' => 'Nov',
                '12' => 'Dec'
            ];

            $months = array_map(function ($month) use ($monthNames) {
                return $monthNames[$month];
            }, $months);

            $revenues = $totalRevenue->pluck('total')->toArray();


            $totalTransactionAmount = Transaction::sum('amount');

            $totalTransactionAmount = Transaction::sum('amount');
            $totalUsers = User::where('role', 'student')->count();
            $totalCourses = Courses::count();
            $totalTeachers = Teacher::count();

          
            $courses = Courses::all();

            $studentCounts = $courses->map(function ($course) {
                return $course->users()->count(); 
            })->toArray();

            $courseNames = $courses->pluck('course_title')->toArray();;



            return view('dashboard.home', [
                'totalTransactionAmount' => $totalTransactionAmount,
                'totalUsers' => $totalUsers,
                'totalCourses' => $totalCourses,
                'totalTeachers' => $totalTeachers,
                ' totalRevenue' =>  $totalRevenue,
                'months' => $months,
                'revenues' => $revenues,
                'courseNames' => $courseNames,
                'studentCounts' => $studentCounts

            ]);
        } else {
            Auth::logout();
            return redirect('/');
        }
    }
}
