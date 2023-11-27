<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function index()
    {
        try {
            $assignments = Assignment::all();


            return response()->json([
                "status" => true,
                "message" => "GET all data assignments successfully",
                "data" => $assignments
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
            $assignment = Assignment::findOrFail($id);

            return response()->json([
                "status" => true,
                "message" => "GET data assignment by id successfully",
                "data" => $assignment
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
                "catatan" => "required",
                "deadline" => "required",
                "metode_pengumpulan" => "required|in:url,file,semua",
                "id_course" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ]);
            }

            Assignment::create($request->all());

            return response()->json([
                "status" => true,
                "message" => "ADD data assignment successfully",
                "data_created" => $request->all()
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
            $assignment = Assignment::findOrFail($id);

            $assignment->update($request->all());

            return response()->json([
                "status" => true,
                "message" => "EDIT data assignment successfully",
                "data_edited" => $request->all()
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
            $assignment = Assignment::findOrFail($id);

            $assignment->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data assignment successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
