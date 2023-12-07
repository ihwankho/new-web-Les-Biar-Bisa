<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function destroy(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/scores/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['status'];

        if (!$response) {
            return redirect('/assignment');
        } else {
            return redirect('/assignment');
        }
    }
}
