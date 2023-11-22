<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\FileCourse;
use App\Models\Score;
use DateTime;
use Illuminate\Http\Request;

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
    public function task(String $id)
    {
        $assignment = Assignment::where('id', '=', $id)->first();

        $course = Course::where('id', '=', $assignment->id_course)->first();

        $scores = Score::where('id_user', '=', 1)->get();

        $foundScore = $scores->firstWhere('id_assignment', $assignment->id);

        $status = '';
        if ($foundScore) {
            $status = $foundScore->status;
        } else {
            $status = "belum selesai";
        }

        $dateString = $assignment->deadline;
        $dateTime = new DateTime($dateString);
        $formattedDate = $dateTime->format('d F Y H:i:s');

        $data = [
            "id" => $assignment->id,
            "metode_pengumpulan" => $assignment->metode_pengumpulan,
            "assignment_nama" => $assignment->nama,
            "course_nama" => $course->nama,
            "deadline" => $formattedDate,
            "status" => $status
        ];

        return view('users.page.mycourse.task', compact('data'));
    }

    protected function convertDate($date)
    {
        $dateString = $date;
        $dateTime = new DateTime($dateString);
        $formattedDate = $dateTime->format('d F Y H:i:s');
        return $formattedDate;
    }

    public function assignment(String $id)
    {
        $assignment = Assignment::where('id', '=', $id)->first();

        $course = Course::where('id', '=', $assignment->id_course)->first();

        $scores = Score::where('id_user', '=', 1)->get();

        $foundScore = $scores->firstWhere('id_assignment', $assignment->id);

        $status = '';
        if ($foundScore) {
            $status = $foundScore->status;
        } else {
            $status = "belum selesai";
        }

        $data = [
            "id" => $assignment->id,
            "assignment_nama" => $assignment->nama,
            "course_nama" => $course->nama,
            "deadline" => $this->convertDate($assignment->deadline),
            "waktu_pengajuan" => $this->convertDate($foundScore->created_at),
            "url" => $foundScore->url,
            "file" => $foundScore->file,
            "nilai" => $foundScore->nilai,
            "catatan" => $foundScore->catatan,
            "status" => $status
        ];

        return view('users.page.mycourse.assignment', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_assignment = $request->query('id_assignment');

        $task = Assignment::where('id', '=', $id_assignment)->first();

        $status = "";
        $date = time();
        $taskTime = strtotime($task->deadline);

        if ($date < $taskTime) {
            $status = "selesai";
        } else {
            $status = "terlambat";
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/assignment'), $fileName);

        Score::create([
            "id_user" => 1,
            "id_assignment" => $id_assignment,
            "url" => $request->url,
            "file" => $$fileName,
            "status" => $status
        ]);

        return redirect('/mycourse');
    }

    public function storeass(Request $request)
    {
        $id_assignment = $request->query('id_assignment');

        $task = Assignment::where('id', '=', $id_assignment)->first();
        dd($id_assignment);
        // $status = "";
        // $date = time();
        // $taskTime = strtotime($task->deadline);

        // if ($date < $taskTime) {
        //     $status = "selesai";
        // } else {
        //     $status = "terlambat";
        // }

        // Score::create([
        //     "id_user" => 1,
        //     "id_assignment" => $id_assignment,
        //     "url" => $request->url,
        //     "file" => $request->file,
        //     "status" => $status
        // ]);

        // return redirect('/assignment');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $course = Course::where('id', '=', $id)->first();

        $file_course = FileCourse::where('id_course', '=', $id)->get();

        $assignment = Assignment::where('id_course', '=', $id)->get();

        $scores = Score::where('id_user', '=', 1)->get();

        $data = collect([]);


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

            $data->push($taskData);
        }

        return view('users.page.mycourse.show', compact('data', 'course', 'file_course'));
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
