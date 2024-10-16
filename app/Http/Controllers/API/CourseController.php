<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\QuizNotificationMail;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $idTingkatan = request("id-tingkatan");
            if ($idTingkatan != null) {

                $courses = Course::with('tingkatan')->where("id_tingkatan", "=", $idTingkatan)->get();
            } else {

                $courses = Course::with('tingkatan')->get();
            }

            for ($i = 0; $i < $courses->count(); $i++) {
                $courses[$i]['thumbnail'] = url('/assets/course/' . $courses[$i]['thumbnail']);
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data course successfully",
                "data" => $courses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e
            ]);
        }
    }

    public function show(String $id)
    {
        try {
            $course = Course::findOrFail($id);

            $course['thumbnail'] = url('/assets/course/' . $course['thumbnail']);

            return response()->json([
                "status" => true,
                "message" => "GET data course by id successfully",
                "data" => $course
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
                "deskripsi" => "required",
                "thumbnail" => "required|image|mimes:jpeg,jpg,png",
                "id_tingkatan" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ], 422);
            }

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/course'), $fileName);
            }

            Course::create([
                "nama" => $request->nama,
                "deskripsi" => $request->deskripsi,
                "thumbnail" => $fileName,
                "id_tingkatan" => $request->id_tingkatan
            ]);

            return response()->json([
                "status" => true,
                "message" => "ADD data course successfully",
                "data" => [
                    "nama" => $request->nama,
                    "deskripsi" => $request->deskripsi,
                    "thumbnail" => url('/assets/course/' . $fileName),
                    "id_tingkatan" => $request->id_tingkatan
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
            $course = Course::findOrFail($id);

            $fileName = $course['thumbnail'];

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                unlink(public_path('/assets/course/' . $fileName));
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/course/'), $fileName);
            }

            $course->update([
                "nama" => $request->nama,
                "deskripsi" => $request->deskripsi,
                "thumbnail" => $fileName,
                "id_tingkatan" => $request->id_tingkatan
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data course successfully",
                "data" => [
                    "nama" => $request->nama,
                    "deskripsi" => $request->deskripsi,
                    "thumbnail" => $fileName,
                    "id_tingkatan" => $request->id_tingkatan
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
            $course = Course::findOrFail($id);

            $fileName = $course['thumbnail'];

            unlink(public_path('/assets/course/' . $fileName));

            $course->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data course successfully",

            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
