<?php

namespace App\Http\Controllers;

use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AssignmentController extends Controller
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
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = json_decode($client->request("GET", $url . '/courses', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $courses = collect([]);
        foreach ($course as $crs) {
            if ($crs['id_tingkatan'] == $user['id_tingkatan']) {
                $courses->push($crs);
            }
        }

        $file = json_decode($client->request("GET", $url . "/filecourses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $file_course = collect([]);
        foreach ($file as $item) {
            foreach ($courses as $crs) {
                if ($crs['id'] == $item['id_course']) {
                    $file_course->push($item);
                    break;
                }
            }
        }

        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $scores = collect([]);
        foreach ($score as $scr) {
            if ($scr['id_user'] == $request->session()->get('id_user')) {
                $scores->push($scr);
            }
        }

        $data = collect([]);

        foreach ($courses as $course) {
            $temporary = collect([]);
            $assignments = json_decode($client->request("GET", $url . '/assignments', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];

            $assignment = collect([]);
            foreach ($assignments as $ass) {
                if ($ass['id_course'] == $course['id']) {
                    $assignment->push($ass);
                }
            }
            foreach ($assignment as $task) {
                $dateString = $task['deadline'];
                $dateTime = new DateTime($dateString);
                $formattedDate = $dateTime->format('d F Y H:i:s');

                $taskData = [
                    "id" => $task['id'],
                    "nama" => $task['nama'],
                    "deadline" => $formattedDate,
                ];

                $foundScore = $scores->firstWhere('id_assignment', $task['id']);

                if ($foundScore) {
                    $taskData["status"] = $foundScore['status'];
                } else {
                    $taskData["status"] = "belum selesai";
                }

                $temporary->push($taskData);
            }

            $data->push([
                "course" => $course['nama'],
                "assignment" => $temporary
            ]);
        }

        return view('users.page.assignment.index', compact('data'));
    }
}
