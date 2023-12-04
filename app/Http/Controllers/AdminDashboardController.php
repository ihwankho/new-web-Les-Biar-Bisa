<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");

        $users = json_decode($client->request("GET", $url . '/users')->getBody(), true)['data'];
        $scores = json_decode($client->request("GET", $url . '/scores')->getBody(), true)['data'];
        $payments = json_decode($client->request("GET", $url . '/payments')->getBody(), true)['data'];
        $tingkatan = json_decode($client->request("GET", $url . '/tingkatan')->getBody(), true)['data'];

        $countScore = 0;
        foreach ($scores as $score) {
            if ($score['status'] != 'pending') {
                $countScore++;
            }
        }

        $countPayment = 0;
        foreach ($payments as $payment) {
            if ($payment['status'] != 'pending') {
                $countPayment++;
            }
        }

        $i = 1;
        $data = [
            "active_student" => count($users),
            "new_assignment" => $countScore,
            "payment" => $countPayment,
            "schedule" => $tingkatan,
            "students" => $users
        ];

        return view('admin.page.dashboard.index', compact('data', 'i'));
    }
}
