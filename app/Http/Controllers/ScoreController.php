<?php

namespace App\Http\Controllers;

use App\Models\Score;
use GuzzleHttp\Client;

class ScoreController extends Controller
{
    public function destroy(String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/scores/" . $id)->getBody(), true)['status'];

        if (!$response) {
            return redirect('/assignment');
        } else {
            return redirect('/assignment');
        }
    }
}
