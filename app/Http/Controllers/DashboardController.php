<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $user = json_decode($client->request("GET", $url . "/users/" . $request->session()->get('id_user'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];
        $course = 0;
        $courses = json_decode($client->request("GET", $url . "/courses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        foreach ($courses as $item) {
            if ($item['id_tingkatan'] == $user['id_tingkatan']) {
                $course++;
            }
        }

        $assignment = json_decode($client->request("GET", $url . "/assignments", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $notdone = 0;
        $misseddeadline = 0;

        foreach ($assignment as $ass) {
            $assignmentDone = false;

            foreach ($score as $sc) {
                if ($ass['id'] == $sc['id_assignment']) {
                    $assignmentDone = true;
                    break;
                }
            }

            if (!$assignmentDone) {
                $notdone++;

                if (time() > strtotime($ass['deadline'])) {
                    $misseddeadline++;
                }
            }
        }

        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $doneCount = 0;
        foreach ($score as $scr) {
            if ($scr['id_user'] ==  $request->session()->get('id_user') && $scr['status'] == 'selesai') {
                $doneCount++;
            }
        }

        $lateCount = 0;
        foreach ($score as $scr) {
            if ($scr['id_user'] ==  $request->session()->get('id_user') && $scr['status'] == 'terlambat') {
                $lateCount++;
            }
        }

        $assignment = [
            "done" => $doneCount,
            "late" => $lateCount,
            "notdone" => $notdone,
            "misseddeadline" => $misseddeadline
        ];

        $users = json_decode($client->request("GET", $url . "/users", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $username = "";
        foreach ($users as $usr) {
            if ($usr['id'] == $request->session()->get('id_user')) {
                $username = $usr;
                break;
            }
        }

        $schedule = json_decode($client->request("GET", $url . "/tingkatan/" . $username['id_tingkatan'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('users.page.dashboard.index', compact('schedule', 'assignment', 'course'));
    }
}
