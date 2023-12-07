<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url = env('API_URL');

        $users = json_decode($client->request("GET", $url . '/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $username = null;
        foreach ($users as $user) {
            if ($user['id'] == $request->session()->get('id_user')) {
                $username = $user;
            }
        }

        $schedule = json_decode($client->request("GET", $url . "/tingkatan/" . $username['id_tingkatan'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('users.page.schedule.index', compact('schedule'));
    }

    public function admin(Request $request)
    {
        $client = new Client();
        $url = env('API_URL');
        $schedule = json_decode($client->request("GET", $url . '/tingkatan', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $data = collect([]);

        foreach ($schedule as $sch) {
            $nama = "";
            $schedule = "";
            if ($sch['nama'] == "SD") {
                $nama = "Schedule Sekolah Dasar";
                $schedule = $sch['jadwal'];
            } else if ($sch['nama'] == "SMP") {
                $nama = "Schedule Sekolah Menengah Pertama";
                $schedule = $sch['jadwal'];
            } else if ($sch['nama'] == "SMA") {
                $nama = "Schedule Sekolah Menengah Atas";
                $schedule = $sch['jadwal'];
            }

            $item = [
                "id" => $sch['id'],
                "nama" => $nama,
                "schedule" => $schedule
            ];

            $data->push($item);
        }

        return view('admin.page.schedule.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.page.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/tingkatan", [
            "multipart" => [
                [
                    "name" => "nama",
                    "contents" => $request->nama,
                ], [
                    "name" => "jadwal",
                    "contents" => fopen($request->file('jadwal'), 'r'),
                    "filename" => $request->file('jadwal')->getClientOriginalName(),
                    "headers" => [
                        "Content-Type" => "<Content-type header>"
                    ]
                ]
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true);

        if (!$response['status']) {
            return redirect('/admin/schedule')->with('failed', 'Failed add schedule');;
        }

        return redirect('/admin/schedule')->with('success', 'Success add schedule');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $client = new Client();
        $url = env('API_URL');

        $schedule = json_decode($client->request("GET",  $url . '/tingkatan/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('admin.page.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->nama && !$request->hasFile('jadwal')) {
            $response = json_decode($client->request("POST", $url . "/tingkatan/" . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama,
                    ]
                ]
            ], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        } else if ($request->nama && $request->hasFile('jadwal')) {
            $response = json_decode($client->request("POST", $url . "/tingkatan/" . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama,
                    ], [
                        "name" => "jadwal",
                        "contents" => fopen($request->file('jadwal'), 'r'),
                        "filename" => $request->file('jadwal')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ]
                ]
            ], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        }

        if (!$response) {
            return redirect('/admin/schedule')->with('failed', 'Failed change schedule');
        }

        return redirect('/admin/schedule')->with('success', 'Success change schedule');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/tingkatan/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['status'];

        if (!$response) {
            return redirect('/admin/schedule')->with('failed', "Failed delete schedule");
        }

        return redirect('/admin/schedule')->with('success', "Success delete schedule");
    }
}
