<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");

        $i = 1;
        $data = json_decode($client->request("GET", $url . '/users')->getBody(), true)['data'];

        return view('admin.page.account.index', compact('data', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = new Client();
        $url = env("API_URL");

        $tingkatan = json_decode($client->request("GET", $url . '/tingkatan')->getBody(), true)['data'];

        return view('admin.page.account.create', compact('tingkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $client->request("POST", $url . '/users', [
            "multipart" => [
                [
                    "name" => "username",
                    "contents" => $request->username
                ],
                [
                    "name" => "fullname",
                    "contents" => $request->fullname
                ],
                [
                    "name" => "password",
                    "contents" => $request->password
                ],
                [
                    "name" => "id_tingkatan",
                    "contents" => $request->tingkatan
                ],
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ]);

        return redirect('/admin/account')->with('success', 'Success create account');
    }

    public function edit(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");
        $users = json_decode($client->request("GET", $url . "/users/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $tingkatan = json_decode($client->request("GET", $url . '/tingkatan', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('admin.page.account.edit', compact('users', 'tingkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = new Client();
        $url = env('API_URL');

        $response = json_decode($client->request('POST', $url . '/users/' . $id, [
            "multipart" => [
                [
                    "name" => "username",
                    "contents" => $request->username
                ],
                [
                    "name" => "fullname",
                    "contents" => $request->fullname
                ],
                [
                    "name" => "password",
                    "contents" => $request->password
                ],
                [
                    "name" => "tingkatan",
                    "contents" => $request->tingkatan
                ],
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody())->status;

        if (!$response) {
            return redirect('/admin/account')->with('failed', 'Failed update account');
        }

        return redirect('/admin/account')->with('success', 'Success update account');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $client = new Client();
        $url = env('API_URL');

        $response = json_decode($client->request('DELETE', $url . '/users/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['status'];

        if (!$response) {
            return redirect('/admin/account')->with('failed', 'Failed delete account');
        }

        return redirect('/admin/account')->with('success', 'Success delete account');
    }
}
