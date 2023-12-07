<?php

namespace App\Http\Controllers;

use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CourseController extends Controller
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

        $course = json_decode($client->request("GET", $url . "/courses", [
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

        $file_course = json_decode($client->request("GET", $url . "/filecourses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $file_courses = 0;
        foreach ($file_course as $item) {
            foreach ($courses as $crs) {
                if ($item['id_course'] == $crs['id']) {
                    $file_courses++;
                    break;
                }
            }
        }

        $assignments = json_decode($client->request("GET", $url . "/assignments", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $assignment = 0;
        foreach ($assignments as $item) {
            foreach ($courses as $crs) {
                if ($item['id_course'] == $crs['id']) {
                    $assignment++;
                    break;
                }
            }
        }

        return view('users.page.mycourse.index', ['courses' => $courses, 'file_courses' => $file_courses, 'assignments' => $assignment]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function task(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $assignment = json_decode($client->request("GET", $url . "/assignments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = json_decode($client->request("GET", $url . "/courses/" . $assignment['id_course'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $scores = collect([]);
        foreach ($score as $scr) {
            if ($scr['id_user'] ==  $request->session()->get('id_user')) {
                $scores->push($scr);
            }
        }

        $foundScore = $scores->firstWhere('id_assignment', $assignment['id']);

        $status = '';
        if ($foundScore) {
            $status = $foundScore['status'];
        } else {
            $status = "belum selesai";
        }

        $dateString = $assignment['deadline'];
        $dateTime = new DateTime($dateString);
        $formattedDate = $dateTime->format('d F Y H:i:s');

        $data = [
            "id" => $assignment['id'],
            "metode_pengumpulan" => $assignment['metode_pengumpulan'],
            "assignment_nama" => $assignment['nama'],
            "course_nama" => $course['nama'],
            "deadline" => $formattedDate,
            "status" => $status
        ];

        return view('users.page.mycourse.task', compact('data'));
    }

    protected function convertDate($date)
    {
        $dateString = $date;
        $dateTime = new DateTime($dateString);
        $formattedDate = $dateTime->format('d F Y H:i:s');
        return $formattedDate;
    }

    public function assignment(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");
        $assignment = json_decode($client->request("GET", $url . "/assignments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = json_decode($client->request("GET", $url . "/courses/" . $assignment['id_course'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $scores = collect([]);
        foreach ($score as $scr) {
            if ($scr['id_user'] ==  $request->session()->get('id_user')) {
                $scores->push($scr);
            }
        }

        $foundScore = $scores->firstWhere('id_assignment', $assignment['id']);

        $status = '';
        if ($foundScore) {
            $status = $foundScore['status'];
        } else {
            $status = "belum selesai";
        }

        $data = [
            "id" => $assignment['id'],
            "id_score" => $foundScore['id'],
            "assignment_nama" => $assignment['nama'],
            "course_nama" => $course['nama'],
            "deadline" => $this->convertDate($assignment['deadline']),
            "waktu_pengajuan" => $this->convertDate($foundScore['created_at']),
            "nama" => $foundScore['nama'],
            "url" => $foundScore['url'],
            "file" => $foundScore['file'],
            "nilai" => $foundScore['nilai'],
            "catatan" => $foundScore['catatan'],
            "status" => $status
        ];

        return view('users.page.mycourse.assignment', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $id_assignment = $request->query('id_assignment');

        $task = json_decode($client->request("GET", $url . "/assignments/" . $id_assignment, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $status = "";
        $date = time();
        $taskTime = strtotime($task['deadline']);

        if ($date < $taskTime) {
            $status = "selesai";
        } else {
            $status = "terlambat";
        }

        if ($request->hasFile('file')) {
            $response = json_decode($client->request("POST", $url . "/scores", [
                "multipart" => [
                    [
                        "name" => "id_user",
                        "contents" =>  $request->session()->get('id_user')
                    ],
                    [
                        "name" => "id_assignment",
                        "contents" => $id_assignment
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "url",
                        "contents" => $request->url
                    ],
                    [
                        "name" => "status",
                        "contents" => $status
                    ],
                    [
                        "name" => "file",
                        "contents" => fopen($request->file('file'), 'r'),
                        "filename" => $request->file('file')->getClientOriginalName(),
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
            $response = json_decode($client->request("POST", $url . "/scores", [
                "multipart" => [
                    [
                        "name" => "id_user",
                        "contents" =>  $request->session()->get('id_user')
                    ],
                    [
                        "name" => "id_assignment",
                        "contents" => $id_assignment
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "url",
                        "contents" => $request->url
                    ],
                    [
                        "name" => "status",
                        "contents" => $status
                    ],
                ]
            ])->getBody(), true)['status'];
        }

        if ($response) {
            return redirect('/mycourse/assignment/' . $id_assignment);
        } else {
            return redirect('/mycourse/assignment/' . $id_assignment);
        }
    }

    public function storeass(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $id_assignment = $request->query('id_assignment');

        $task = json_decode($client->request("GET", $url . "/assignments/" . $id_assignment, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $status = "";
        $date = time();
        $taskTime = strtotime($task['deadline']);

        if ($date < $taskTime) {
            $status = "selesai";
        } else {
            $status = "terlambat";
        }

        if ($request->hasFile('file')) {
            $response = json_decode($client->request("POST", $url . "/scores", [
                "multipart" => [
                    [
                        "name" => "id_user",
                        "contents" =>  $request->session()->get('id_user')
                    ],
                    [
                        "name" => "id_assignment",
                        "contents" => $id_assignment
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "url",
                        "contents" => $request->url
                    ],
                    [
                        "name" => "status",
                        "contents" => $status
                    ],
                    [
                        "name" => "file",
                        "contents" => fopen($request->file('file'), 'r'),
                        "filename" => $request->file('file')->getClientOriginalName(),
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
            $response = json_decode($client->request("POST", $url . "/scores", [
                "multipart" => [
                    [
                        "name" => "id_user",
                        "contents" =>  $request->session()->get('id_user')
                    ],
                    [
                        "name" => "id_assignment",
                        "contents" => $id_assignment
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "url",
                        "contents" => $request->url
                    ],
                    [
                        "name" => "status",
                        "contents" => $status
                    ],
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        }

        if ($response) {
            return redirect('/assignment');
        } else {
            return redirect('/assignment');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $course = json_decode($client->request("GET", $url . "/courses/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $file_courses = json_decode($client->request("GET", $url . "/filecourses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $file_course = collect([]);
        foreach ($file_courses as $file) {
            if ($file['id_course'] == $id) {
                $file_course->push($file);
            }
        }

        $assignments = json_decode($client->request("GET", $url . "/assignments", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $assignment = collect([]);
        foreach ($assignments as $ass) {
            if ($ass['id_course'] == $id) {
                $assignment->push($ass);
            }
        }

        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $scores = collect([]);
        foreach ($score as $sc) {
            if ($sc['id_user'] ==  $request->session()->get('id_user')) {
                $scores->push($sc);
            }
        }

        $data = collect([]);


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

            $data->push($taskData);
        }

        return view('users.page.mycourse.show', compact('data', 'course', 'file_course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $assignment = json_decode($client->request("GET", $url . "/assignments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = json_decode($client->request("GET", $url . "/courses/" . $assignment['id_course'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $score = json_decode($client->request("GET", $url . "/scores", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $scores = collect([]);
        foreach ($score as $scr) {
            if ($scr['id_user'] ==  $request->session()->get('id_user')) {
                $scores->push($scr);
            }
        }

        $foundScore = $scores->firstWhere('id_assignment', $assignment['id']);

        $status = '';
        if ($foundScore) {
            $status = $foundScore['status'];
        } else {
            $status = "belum selesai";
        }

        $dateString = $assignment['deadline'];
        $dateTime = new DateTime($dateString);
        $formattedDate = $dateTime->format('d F Y H:i:s');

        $data = [
            "id" => $assignment['id'],
            "metode_pengumpulan" => $assignment['metode_pengumpulan'],
            "assignment_nama" => $assignment['nama'],
            "nama" => $foundScore['nama'],
            "url" => $foundScore['url'],
            "file" => $foundScore['file'],
            "course_nama" => $course['nama'],
            "deadline" => $formattedDate,
            "status" => $status
        ];

        return view('users.page.assignment.edit', compact('data'));
    }
}
