<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $teachers = Teacher::all();
        return view('dashboard/teachers', compact('teachers'));
    }


    /**e
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'experience' => 'nullable|string',
        ]);

        $teacher = Teacher::findOrFail($id);

        $teacher->update($validated);

        return response()->json(['success' => true]);
    }


    public function teacher_courses($id)
    {

        $courses = DB::table('courses')
            ->join('teachers', 'courses.teacher_id', '=', 'teachers.teacher_id')
            ->where('teachers.teacher_id', $id)
            ->select('courses.*')
            ->get();

        $user = Teacher::findOrFail($id);


        return view('dashboard\teacherCourses', [
            'user' => $user,
            'courses' => $courses,
        ]);
    }
}
