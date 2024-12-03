<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $courses = Courses::all();
        return view('dashboard/courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $courses)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_title' => 'required|string|max:255',
            'course_description' => 'required|string',
            'course_price' => 'required|numeric',
            'course_duration' => 'required|string|max:255',
            'diffculty_leve' => 'required|in:beginner,intermediate,advanced',
            'course_image' => 'nullable|image|max:2048',
        ]);

        $course = Courses::findOrFail($id);
        $course->course_title = $request->course_title;
        $course->course_description = $request->course_description;
        $course->course_price = $request->course_price;
        $course->course_duration = $request->course_duration;
        $course->diffculty_leve = $request->diffculty_leve;

        if ($request->hasFile('course_image')) {
            $file = $request->file('course_image');
            $imagePath = 'dashboard_assets/images/product/' . $file->getClientOriginalName();
            $file->move(public_path('dashboard_assets/images/product/'), $file->getClientOriginalName());
            $course->course_image = basename($imagePath);
        }

        $course->save();

        return response()->json(['success' => true, 'message' => 'Course updated successfully']);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json(['success' => false, 'message' => 'Course not found'], 404);
        }

        $course->delete(); // Soft delete

        return response()->json(['success' => true, 'message' => 'Course soft deleted successfully']);
    }
}
