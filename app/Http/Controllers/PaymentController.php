<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $datas = json_decode($client->request("GET", $url . "/payments", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $i =  1;

        $data = collect([]);
        foreach ($datas as $item) {
            if ($item['id_user'] == $request->session()->get('id_user')) {
                $data->push($item);
            }
        }

        return view('users.page.payment.index', compact('data', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.page.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->hasFile('bukti')) {
            $response = json_decode($client->request("POST", $url . "/payments", [
                "multipart" => [
                    [
                        "name" => "id_user",
                        "contents" =>  $request->session()->get('id_user')
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "note",
                        "contents" => $request->catatan
                    ],
                    [
                        "name" => "bukti",
                        "contents" => fopen($request->file('bukti'), 'r'),
                        "filename" => $request->file('bukti')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ]
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ]
            ])->getBody(), true)['status'];
        } else {
            $response = json_decode($client->request("POST", $url . "/payments", [
                "multipart" => [
                    [
                        "name" => "id_user",
                        "contents" =>  $request->session()->get('id_user')
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "note",
                        "contents" => $request->catatan
                    ],
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        }

        if (!$response) {
            return redirect('/payment')->with('failed', 'Failed add payment');
        } else {
            return redirect('/payment')->with('success', 'Success add payment');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $payment = json_decode($client->request("GET", $url . "/payments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('users.page.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $data = json_decode($client->request("GET", $url . "/payments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('users.page.payment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->hasFile("bukti")) {
            $response = json_decode($client->request("POST", $url . "/payments/" . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "note",
                        "contents" => $request->catatan
                    ],
                    [
                        "name" => "bukti",
                        "contents" => fopen($request->file('bukti'), 'r'),
                        "filename" => $request->file('bukti')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ]
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        } else {
            $response = json_decode($client->request("POST", $url . "/payments/" . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "note",
                        "contents" => $request->catatan
                    ],
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        }

        if (!$response) {
            return redirect('/payment')->with('failed', "Failed data success!");
        } else {
            return redirect('/payment')->with('success', "Edit data success!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/payments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['status'];

        if (!$response) {
            return redirect('/payment')->with('failed', 'Failed delete book data!');
        } else {
            return redirect('/payment')->with('success', 'Success delete book data!');
        }
    }
}
