<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\FileCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        $file_courses = FileCourse::all()->count();

        $assignment = Assignment::all()->count();

        return view('users.page.mycourse.index', ['courses' => $courses, 'file_courses' => $file_courses, 'assignments' => $assignment]);
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
    public function show(String $id)
    {
        $course = Course::where('id', '=', $id)->first();

        $file_course = FileCourse::where('id_course', '=', $id)->get();

        $assignment = Assignment::where('id_course', '=', $id)->get();

        return view('users.page.mycourse.show', compact('course', 'file_course', 'assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
