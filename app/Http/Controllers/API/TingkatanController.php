<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tingkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TingkatanController extends Controller
{
    public function index()
    {
        try {
            $tingkatan = Tingkatan::all();

            for ($i = 0; $i < $tingkatan->count(); $i++) {
                $tingkatan[$i]['jadwal'] = url('/assets/schedule/' . $tingkatan[$i]['jadwal']);
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data tingkatan successfully",
                "data" => $tingkatan
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
            $tingkatan = Tingkatan::findOrFail($id);

            $tingkatan['jadwal'] = url('/assets/schedule/' . $tingkatan['jadwal']);

            return response()->json([
                "status" => true,
                "message" => "GET data tingkatan by id successfully",
                "data" => $tingkatan
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
                "nama" => "required|in:SD,SMP,SMA",
                "jadwal" => "required|image|mimes:jpeg,jpg,png"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ]);
            }

            if ($request->hasFile('jadwal')) {
                $file = $request->file("jadwal");
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/schedule'), $fileName);
            }

            Tingkatan::create([
                "nama" => $request->nama,
                "jadwal" => $fileName
            ]);

            return response()->json([
                "status" => true,
                "message" => "ADD data tingkatan successfully",
                "data" => [
                    "nama" => $request->nama,
                    "jadwal" => url('/assets/schedule/' . $fileName)
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
            $tingkatan = Tingkatan::findOrFail($id);

            $fileName = $tingkatan->jadwal;
            if ($request->hasFile('jadwal')) {
                $file = $request->file('jadwal');
                unlink(public_path('/assets/schedule/' . $fileName));
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/assets/schedule'), $fileName);
            }

            $tingkatan->update([
                "nama" => $request->nama,
                "jadwal" => $fileName
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data tingkatan successfully",
                "data" => $request->all()
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
            $tingkatan = Tingkatan::findOrFail($id);

            $fileName = $tingkatan->jadwal;

            unlink(public_path('/assets/schedule/' . $fileName));

            $tingkatan->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data tingkatan successfully",

            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
