<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['username', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Username & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('username', $request->username)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                "data" => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "username" => "required|unique:Users",
                "fullname" => "required",
                "password" => "required",
                "role" => "required|in:user,admin",
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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "status" => true,
            "message" => "You're logout successfully"
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            "status" => true,
            "user" => Auth::user()
        ]);
    }

    public function login_user()
    {
        return view('users.page.login');
    }

    public function user_login(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/login", [
            "multipart" => [
                [
                    "name" => "username",
                    "contents" => $request->username
                ],
                [
                    "name" => "password",
                    "contents" => $request->password
                ],
            ]
        ])->getBody(), true);

        if ($response['status']) {
            session([
                'id_user' => $response['data']['id'],
                'fullname' => $response['data']['fullname'],
                'role' => $response['data']['role'],
                'token' => $response['token'],
            ]);

            if ($response['data']['role'] == "admin") {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/dashboard');
            }
        }
    }

    public function user_logout(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("GET", $url . "/logout", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true);

        if ($response['status']) {
            $request->session()->flush();
            return redirect('/login');
        }
    }
}
