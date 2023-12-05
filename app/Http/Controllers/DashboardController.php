<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");

        $course = count(json_decode($client->request("GET", $url . "/courses")->getBody(), true)['data']);

        $assignment = json_decode($client->request("GET", $url . "/assignments")->getBody(), true)['data'];
        $score = json_decode($client->request("GET", $url . "/scores")->getBody(), true)['data'];
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

        $score = json_decode($client->request("GET", $url . "/scores")->getBody(), true)['data'];
        $doneCount = 0;
        foreach ($score as $scr) {
            if ($scr['id_user'] == 1 && $scr['status'] == 'selesai') {
                $doneCount++;
            }
        }

        $lateCount = 0;
        foreach ($score as $scr) {
            if ($scr['id_user'] == 1 && $scr['status'] == 'terlambat') {
                $lateCount++;
            }
        }

        $assignment = [
            "done" => $doneCount,
            "late" => $lateCount,
            "notdone" => $notdone,
            "misseddeadline" => $misseddeadline
        ];

        $users = json_decode($client->request("GET", $url . "/users")->getBody(), true)['data'];
        $username = "";
        foreach ($users as $usr) {
            if ($users['username'] == "mallexibra") {
                $username = $usr;
                return;
            }
        }

        $schedule = json_decode($client->request("GET", $url . "/tingkatan/" . $username['id_tingkatan'])->getBody(), true)['data'];

        return view('users.page.dashboard.index', compact('schedule', 'assignment', 'course'));
    }
}
