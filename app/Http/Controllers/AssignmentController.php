<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\FileCourse;
use App\Models\Score;
use DateTime;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        $file_course = FileCourse::all();

        $scores = Score::where('id_user', '=', 1)->get();

        $data = collect([]);

        foreach ($courses as $course) {
            $temporary = collect([]);
            $assignment = Assignment::where('id_course', $course->id)->get();
            foreach ($assignment as $task) {
                $dateString = $task->deadline;
                $dateTime = new DateTime($dateString);
                $formattedDate = $dateTime->format('d F Y H:i:s');

                $taskData = [
                    "id" => $task->id,
                    "nama" => $task->nama,
                    "deadline" => $formattedDate,
                ];

                $foundScore = $scores->firstWhere('id_assignment', $task->id);

                if ($foundScore) {
                    $taskData["status"] = $foundScore->status;
                } else {
                    $taskData["status"] = "belum selesai";
                }

                $temporary->push($taskData);
            }
            $data->push([
                "course" => $course->nama,
                "assignment" => $temporary
            ]);
        }

        return view('users.page.assignment.index', compact('data'));
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
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
