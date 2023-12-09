<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
{
    public function index()
    {
        try {
            $scores = Score::all();

            for ($i = 0; $i < $scores->count(); $i++) {
                if ($scores[$i]->file != null) {
                    $scores[$i]['file'] = url('/assets/assignment/' . $scores[$i]['file']);
                }
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data score successfully",
                "data" => $scores
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
            $score = Score::findOrFail($id);

            if ($score->file != null) {
                $score['file'] = url('/assets/assignment/' . $score->file);
            }

            return response()->json([
                "status" => true,
                "message" => "GET data score by id successfully",
                "data" => $score
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
                "id_user" => "required",
                "id_assignment" => "required",
                "status" => "required|in:belum_selesai,terlambat,selesai",
                "nama" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ], 422);
            }

            $fileName = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/assignment'), $fileName);
            }

            $url = null;
            if ($request->url) {
                $url = $request->url;
            }

            Score::create([
                "id_user" => $request->id_user,
                "id_assignment" => $request->id_assignment,
                "status" => $request->status,
                "nama" => $request->nama,
                "url" => $url,
                "file" => $fileName
            ]);

            return response()->json([
                "status" => true,
                "message" => "ADD data score successfully",
                "data_created" => [
                    "id_user" => $request->id_user,
                    "id_assignment" => $request->id_assignment,
                    "status" => $request->status,
                    "nama" => $request->nama,
                    "url" => $url,
                    "file" => $fileName
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
            $score = Score::findOrFail($id);

            $fileName = $score->file;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/assignment'), $fileName);
            }

            $url = $score->url;
            if ($request->url) {
                $url = $request->url;
            }

            $nilai = $score->nilai;
            $catatan = $score->catatan;
            $nama = $score->nama;
            $status = $score->status;

            if ($request->status) {
                $status = $request->status;
            }

            if ($request->nama) {
                $nama = $request->nama;
            }

            if ($request->nilai) {
                $nilai = $request->nilai;
            }

            if ($request->catatan) {
                $catatan = $request->catatan;
            }

            $score->update([
                "status" => $status,
                "nama" => $nama,
                "url" => $url,
                "file" => $fileName,
                "nilai" => $nilai,
                "catatan" => $catatan,
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data score by id successfully",
                "data_created" => [
                    "status" => $status,
                    "nama" => $nama,
                    "url" => $url,
                    "file" => url('/assets/assignment/' . $fileName),
                    "nilai" => $nilai,
                    "catatan" => $catatan
                ],
                "id_assignment" => $score->id_assignment
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

            $score = Score::findOrFail($id);

            if ($score->file != null) {
                unlink(public_path('/assets/assignment/' . $score->file));
            }

            $score->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data score by id successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
