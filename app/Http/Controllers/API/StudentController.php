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
            $users = User::with('tingkatan')->get();

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

            $username = $user->username;
            if ($request->username) {
                $username = $request->username;
            }

            $fullname = $user->fullname;
            if ($request->fullname) {
                $fullname = $request->fullname;
            }

            $id_tingkatan = $user->id_tingkatan;
            if ($request->tingkatan) {
                $id_tingkatan = $request->tingkatan;
            }

            $password = $user->password;
            if ($request->password) {
                $password = Hash::make($request->password);
            }

            $user->update([
                "username" => $username,
                "fullname" => $fullname,
                "id_tingkatan" => $id_tingkatan,
                "password" => $password
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data user by id successfully",
                "data" => [
                    "username" => $username,
                    "fullname" => $fullname,
                    "id_tingkatan" => $id_tingkatan,
                    "password" => $password
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
