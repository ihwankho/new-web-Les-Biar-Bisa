<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\FileCourse;
use App\Models\Tingkatan;
use DateTime;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();

        $data = collect([]);

        foreach ($course as $crs) {
            $item = [
                "id" => $crs->id,
                "nama" => $crs->nama,
                "thumbnail" => $crs->thumbnail,
                "materi" => FileCourse::where('id_course', '=', $crs->id)->count(),
                "assignment" => Assignment::where('id_course', '=', $crs->id)->count(),
                "tingkatan" => Tingkatan::where('id', '=', $crs->id_tingkatan)->first('nama')
            ];

            $data->push($item);
        }

        return view('admin.page.course.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tingkatan = Tingkatan::all();

        return view('admin.page.course.create', compact('tingkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('thumbnail');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('/assets/course'), $fileName);

        Course::create([
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "id_tingkatan" => $request->tingkatan,
            "thumbnail" => $fileName
        ]);

        return redirect('/admin/course')->with('success', 'Success add course');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $filecourse = FileCourse::where('id_course', '=', $id)->get();
        $task = Assignment::where('id_course', '=', $id)->get();

        $tasks = collect([]);

        foreach ($task as $t) {
            $dateString = $t->deadline;
            $dateTime = new DateTime($dateString);
            $formattedDate = $dateTime->format('d F Y H:i:s');

            $data = [
                "id" => $t->id,
                "nama" => $t->nama,
                "deadline" => $formattedDate

            ];

            $tasks->push($data);
        }

        return view('admin.page.course.show', compact('filecourse', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tingkatan = Tingkatan::all();

        $course = Course::findOrFail($id);

        return view('admin.page.course.edit', compact('course', 'tingkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $fileName = $course->thumbnail;

        if ($request->file('thumbnail')) {
            unlink(public_path('/assets/course/' . $fileName));
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/course'), $fileName);
        }

        $course->update([
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "thumbnail" => $fileName,
            "id_tingkatan" => $request->tingkatan
        ]);

        return redirect('/admin/course')->with('success', 'Success edit course');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        unlink(public_path('/assets/course/' . $course->thumbnail));

        $course->delete();

        return redirect('/admin/course')->with('success', 'Success delete course');
    }

    public function addmateri(String $id)
    {
        return view('admin.page.course.addmateri');
    }

    public function storemateri(Request $request, String $id)
    {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('/assets/course/materi/'), $fileName);

        FileCourse::create([
            "nama" => $request->nama,
            "file" => $fileName,
            "id_course" => $id
        ]);

        return redirect('/admin/course/' . $id);
    }

    public function addtask(String $id)
    {
        return view('admin.page.course.addtask');
    }

    public function storetask(Request $request, String $id)
    {
        Assignment::create([
            "nama" => $request->nama,
            "catatan" => $request->catatan,
            "deadline" => $request->deadline,
            "metode_pengumpulan" => $request->pengumpulan,
            "id_course" => $id
        ]);

        return redirect('/admin/course/' . $id)->with('success', 'Success add assignment');
    }
}
