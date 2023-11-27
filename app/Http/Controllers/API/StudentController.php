<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();

            return response()->json([
                "status" => true,
                "message" => "GET all data users successfully",
                "data" => $users
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
            $user = User::findOrFail($id);

            return response()->json([
                "status" => true,
                "message" => "GET data user by id successfully",
                "data" => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "username" => "required|unique:Users",
                "fullname" => "required",
                "password" => "required",
                "id_tingkatan" => "required|numeric"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ]);
            }

            $request['password'] = Hash::make($request['password']);

            User::create($request->all());

            return response()->json([
                "status" => true,
                "message" => "ADD data users successfully",
                "data" => $request->all()
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
            $user = User::findOrFail($id);

            $user->update($request->all());

            return response()->json([
                "status" => true,
                "message" => "EDIT data user by id successfully",
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
            $user = User::findOrFail($id);

            $user->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data user successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
