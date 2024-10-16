<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FileCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileCourseController extends Controller
{
    public function index()
    {
        try {
            $idCourse = request('id-course');

            if ($idCourse != null) {
                $fileCourses = FileCourse::where('id_course', '=', $idCourse)->get();
            } else {
                $fileCourses = FileCourse::all();
            }

            for ($i = 0; $i < $fileCourses->count(); $i++) {
                $fileCourses[$i]['file'] = url('/assets/course/materi/' . $fileCourses[$i]['file']);
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data file courses successfulyy",
                "data" => $fileCourses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function show(String $id)
    {
        try {
            $fileCourse = FileCourse::findOrFail($id);

            return response()->json([
                "status" => true,
                "message" => "GET data file course by id successfully",
                "data" => $fileCourse
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                "nama" => "required",
                "file" => "required|mimes:jpeg,jpg,png,pdf",
                "id_course" => "required",
                "link" => ["required", "regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+/"]
]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ], 422);
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/course/materi'), $fileName);
            }

            FileCourse::create([
                "nama" => $request->nama,
                "file" => $fileName,
                "id_course" => $request->id_course,
                "link" => $request->link
            ]);

            return response()->json([
                "status" => true,
                "message" => "ADD data file course successfully",
                "data" => [
                    "nama" => $request->nama,
                    "link" => $request->link,
                    "file" => $fileName,
                    "id_course" => $request->id_course
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $fileCourse = FileCourse::findOrFail($id);

            $fileName = $fileCourse->file;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                unlink(public_path('/assets/course/materi/' . $fileName));
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/course/materi'), $fileName);
            }

            $fileCourse->update([
                "nama" => $request->nama,
                "link" => $request->link,
                "file" => $fileName,
                
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data file course successfully",
                "data_edited" => [
                    "nama" => $request->nama,
                    "link" => $request->link,
                    "file" => $fileName,
                    "id_course" => $fileCourse->id_course
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy(String $id)
    {
        try {
            $fileCourse = FileCourse::findOrFail($id);

            $fileName = $fileCourse->file;

            unlink(public_path('/assets/course/materi/' . $fileName));

            $fileCourse->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data file course by id successfully",
                "id_course" => $fileCourse->id_course,
                
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
