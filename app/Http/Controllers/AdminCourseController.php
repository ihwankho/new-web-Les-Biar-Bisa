<?php

namespace App\Http\Controllers;

use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $client = new Client();
        $url = env('API_URL');

        $course = json_decode($client->request("GET", $url . "/courses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $fileCourses = json_decode($client->request("GET", $url . "/filecourses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $assignment = json_decode($client->request("GET", $url . "/assignments", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $tingkatan = json_decode($client->request("GET", $url . "/tingkatan", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $data = collect([]);

        foreach ($course as $crs) {
            $materi = 0;
            foreach ($fileCourses as $file) {
                if ($file['id_course'] == $crs['id']) {
                    $materi++;
                }
            }

            $task = 0;
            foreach ($assignment as $assign) {
                if ($assign['id_course'] == $crs['id']) {
                    $task++;
                }
            }

            $ting = "";
            foreach ($tingkatan as $tingkat) {
                if ($tingkat['id'] == $crs['id_tingkatan']) {
                    $ting = $tingkat['nama'];
                    break;
                }
            }

            $item = [
                "id" => $crs['id'],
                "nama" => $crs['nama'],
                "thumbnail" => $crs['thumbnail'],
                "materi" => $materi,
                "assignment" => $task,
                "tingkatan" => $ting
            ];

            $data->push($item);
        }



        return view('admin.page.course.index', compact('data'));
    }

    public function sd(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $courses = json_decode($client->request("GET", $url . "/courses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = collect([]);
        foreach ($courses as $cours) {
            if ($cours['tingkatan']['nama'] == 'SD') {
                $course->push($cours);
            }
        }


        $data = collect([]);

        foreach ($course as $crs) {
            $materi = json_decode($client->request("GET", $url . "/filecourses", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $countMateri = 0;
            foreach ($materi as $mtr) {
                if ($mtr['id_course'] == $crs['id']) {
                    $countMateri++;
                }
            }

            $assignments = json_decode($client->request("GET", $url . "/assignments", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $countAssignment = 0;
            foreach ($assignments as $ass) {
                if ($ass['id_course'] == $crs['id']) {
                    $countAssignment++;
                }
            }

            $tingkatan =
                json_decode($client->request("GET", $url . "/tingkatan/" . $crs['id_tingkatan'], [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $request->session()->get('token'),
                    ],
                ])->getBody(), true)['data'];

            $item = [
                "id" => $crs['id'],
                "nama" => $crs['nama'],
                "thumbnail" => $crs['thumbnail'],
                "materi" => $countAssignment,
                "assignment" => $countAssignment,
                "tingkatan" => $tingkatan
            ];

            $data->push($item);
        }

        return view('admin.page.course.sd', compact('data'));
    }

    public function smp(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $courses = json_decode($client->request("GET", $url . "/courses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = collect([]);
        foreach ($courses as $cours) {
            if ($cours['tingkatan']['nama'] == 'SMP') {
                $course->push($cours);
            }
        }

        $data = collect([]);

        foreach ($course as $crs) {
            $materi = json_decode($client->request("GET", $url . "/filecourses", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $countMateri = 0;
            foreach ($materi as $mtr) {
                if ($mtr['id_course'] == $crs['id']) {
                    $countMateri++;
                }
            }

            $assignments = json_decode($client->request("GET", $url . "/assignments", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $countAssignment = 0;
            foreach ($assignments as $ass) {
                if ($ass['id_course'] == $crs['id']) {
                    $countAssignment++;
                }
            }

            $tingkatan =
                json_decode($client->request("GET", $url . "/tingkatan/" . $crs['id_tingkatan'], [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $request->session()->get('token'),
                    ],
                ])->getBody(), true)['data'];

            $item = [
                "id" => $crs['id'],
                "nama" => $crs['nama'],
                "thumbnail" => $crs['thumbnail'],
                "materi" => $countAssignment,
                "assignment" => $countAssignment,
                "tingkatan" => $tingkatan
            ];

            $data->push($item);
        }

        return view('admin.page.course.smp', compact('data'));
    }

    public function sma(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $courses = json_decode($client->request("GET", $url . "/courses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = collect([]);
        foreach ($courses as $cours) {
            if ($cours['tingkatan']['nama'] == 'SMA') {
                $course->push($cours);
            }
        }

        $data = collect([]);

        foreach ($course as $crs) {
            $materi = json_decode($client->request("GET", $url . "/filecourses", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $countMateri = 0;
            foreach ($materi as $mtr) {
                if ($mtr['id_course'] == $crs['id']) {
                    $countMateri++;
                }
            }

            $assignments = json_decode($client->request("GET", $url . "/assignments", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $countAssignment = 0;
            foreach ($assignments as $ass) {
                if ($ass['id_course'] == $crs['id']) {
                    $countAssignment++;
                }
            }

            $tingkatan =
                json_decode($client->request("GET", $url . "/tingkatan/" . $crs['id_tingkatan'], [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $request->session()->get('token'),
                    ],
                ])->getBody(), true)['data'];

            $item = [
                "id" => $crs['id'],
                "nama" => $crs['nama'],
                "thumbnail" => $crs['thumbnail'],
                "materi" => $countAssignment,
                "assignment" => $countAssignment,
                "tingkatan" => $tingkatan
            ];

            $data->push($item);
        }

        return view('admin.page.course.sma', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $tingkatan = json_decode($client->request("GET", $url . '/tingkatan', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('admin.page.course.create', compact('tingkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . '/courses', [
            "multipart" => [
                [
                    "name" => "nama",
                    "contents" => $request->nama,
                ],
                [
                    "name" => "deskripsi",
                    "contents" => $request->deskripsi,
                ],
                [
                    "name" => "id_tingkatan",
                    "contents" => $request->tingkatan,
                ],
                [
                    "name" => "thumbnail",
                    "contents" => fopen($request->file('thumbnail'), 'r'),
                    "filename" => $request->file('thumbnail')->getClientOriginalName(),
                    "headers" => [
                        "Content-Type" => "<Content-type header>"
                    ]
                ]
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['status'];

        if (!$response) {
            return redirect('/admin/course')->with('failed', 'Failed add course');
        }

        return redirect('/admin/course')->with('success', 'Success add course');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $filecourses = json_decode($client->request("GET", $url . "/filecourses", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $filecourse = collect([]);
        foreach ($filecourses as $file) {
            if ($file['id_course'] == $id) {
                $filecourse->push($file);
            }
        }

        $task = json_decode($client->request("GET", $url . '/assignments', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $task_store = collect([]);
        foreach ($task as $tas) {
            if ($tas['id_course'] == $id) {
                $task_store->push($tas);
            }
        }

        $tasks = collect([]);

        foreach ($task_store as $t) {
            $dateString = $t['deadline'];
            $dateTime = new DateTime($dateString);
            $formattedDate = $dateTime->format('d F Y H:i:s');

            $data = [
                "id" => $t['id'],
                "nama" => $t['nama'],
                "deadline" => $formattedDate
            ];

            $tasks->push($data);
        }

        return view('admin.page.course.show', compact('filecourse', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $client = new Client();
        $url = env("API_URL");
        $tingkatan = json_decode($client->request("GET", $url . "/tingkatan", [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        $course = json_decode($client->request("GET", $url . '/courses/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('admin.page.course.edit', compact('course', 'tingkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->hasFile('thumbnail')) {
            $response = json_decode($client->request("POST", $url . "/courses/" . $id, [
                "multipart" => [
                    [
                        "name" => "id_tingkatan",
                        "contents" => $request->tingkatan
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "deskripsi",
                        "contents" => $request->deskripsi
                    ],
                    [
                        "name" => "thumbnail",
                        "contents" => fopen($request->file('thumbnail'), 'r'),
                        "filename" => $request->file('thumbnail')->getClientOriginalName(),
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
            $response = json_decode($client->request("POST", $url . "/courses/" . $id, [
                "multipart" => [
                    [
                        "name" => "id_tingkatan",
                        "contents" => $request->tingkatan
                    ],
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "deskripsi",
                        "contents" => $request->deskripsi
                    ],
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['status'];
        }

        if (!$response) {
            return redirect('/admin/course')->with('failed', 'Failed edit course');
        }

        return redirect('/admin/course')->with('success', 'Success edit course');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/courses/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['status'];

        if (!$response) {
            return redirect('/admin/course')->with('failed', 'Failed delete course');
        }

        return redirect('/admin/course')->with('success', 'Success delete course');
    }

    public function addmateri(Request $request)
    {
        return view('admin.page.course.addmateri');
    }

    public function storemateri(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/filecourses", [
            "multipart" => [
                [
                    "name" => "nama",
                    "contents" => $request->nama
                ],
                [
                    "name" => "link",
                    "contents" => $request->link
                ],
                [
                    "name" => "id_course",
                    "contents" => $id
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

        if (!$response) {
            return redirect('/admin/course/' . $id);
        }

        return redirect('/admin/course/' . $id);
    }

    public function addtask(Request $request)
    {
        return view('admin.page.course.addtask');
    }

    public function storetask(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . '/assignments', [
            "multipart" => [
                [
                    "name" => "nama",
                    "contents" => $request->nama
                ],
                [
                    "name" => "catatan",
                    "contents" => $request->catatan
                ],
                [
                    "name" => "deadline",
                    "contents" => $request->deadline
                ],
                [
                    "name" => "metode_pengumpulan",
                    "contents" => $request->pengumpulan
                ],
                [
                    "name" => "id_course",
                    "contents" => $id
                ],

            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true);

        if (!$response['status']) {
            dd($response);
            return redirect('/admin/course/' . $id)->with('failed', 'Failed add assignment');
        }

        return redirect('/admin/course/' . $id)->with('success', 'Success add assignment');
    }

    public function editmateri(Request $request, String $id)
    {
        $client = new Client();
        $url = env('API_URL');

        $materi = json_decode($client->request('GET', $url . '/filecourses/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];

        return view('admin.page.course.editmateri', compact('materi'));
    }

    public function updatemateri(Request $request, String $id)
    {
        $client = new Client();
        $url = env('API_URL');

        if ($request->hasFile('file')) {
            $response = json_decode($client->request("POST", $url . '/filecourses/' . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],

                    [
                        "name" => "link",
                        "contents" => $request->link

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
            ])->getBody(), true);
        } else {
            $response = json_decode($client->request("POST", $url . '/filecourses/' . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "link",
                        "contents" => $request->link
                    ]
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true);
        }

        if ($response['status']) {
            return redirect('/admin/course/' . $response['data_edited']['id_course'])->with('success', 'Success edit file');
        }

        return redirect('/admin/course/' . $response['data_edited']['id_course'])->with('success', 'Success edit file');
    }

    public function destroymateri(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . '/filecourses/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/course/' . $response['id_course'])->with('success', 'Success delete materi');
        }

        return redirect('/admin/course/' . $response['id_course'])->with('success', 'Success delete materi');
    }

    public function edittask(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");
        $task = json_decode($client->request("GET", $url . "/assignments/" . $id)->getBody(), true)['data'];

        return view('admin.page.course.edittask', compact('task'));
    }

    public function updatetask(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/assignments/" . $id, [
            "multipart" => [
                [
                    "name" => "nama",
                    "contents" => $request->nama
                ],
                [
                    "name" => "catatan",
                    "contents" => $request->catatan
                ],
                [
                    "name" => "deadline",
                    "contents" => $request->deadline
                ],
                [
                    "name" => "metode_pengumpulan",
                    "contents" => $request->metode_pengumpulan
                ],
            ], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/course/' . $response['id_course'])->with('failed', 'Failed');
        }
        return redirect('/admin/course/' . $response['id_course'])->with('success', 'Success');
    }

    public function destroytask(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/assignments/" . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/course/' . $response['id_course'])->with('success', 'Success delete materi');
        }
        return redirect('/admin/course/' . $response['id_course'])->with('success', 'Success delete materi');
    }

    public function assignment(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $scores = json_decode($client->request("GET", $url . '/scores', [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true)['data'];
        $score = collect([]);

        foreach ($scores as $scr) {
            if ($scr['id_assignment'] == $id) {
                $score->push($scr);
            }
        }

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

        $data = collect([]);
        foreach ($score as $scr) {
            $user = json_decode($client->request("GET", $url . "/users/" . $request->session()->get('id_user'), [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->session()->get('token'),
                ],
            ])->getBody(), true)['data'];
            $dateString = $scr['created_at'];
            $dateTime = new DateTime($dateString);
            $formattedDate = $dateTime->format('d F Y H:i:s');

            $item = [
                "id" => $scr['id'],
                "id_assignment" => $scr['id_assignment'],
                "nama" => $scr['nama'],
                "waktu_pengumpulan" => $formattedDate,
                "user" => $user['fullname'],
                "file" => $scr['file'],
                "url" => $scr['url'],
                "nilai" => $scr['nilai'],
                "catatan" => $scr['catatan']
            ];

            $data->push($item);
        }

        return view('admin.page.course.assignment', compact('data', 'assignment', 'course'));
    }

    public function nilai(Request $request, String $id)
    {
        $client = new Client();
        $url = env('API_URL');

        $response = json_decode($client->request("POST", $url . "/scores/" . $id, [
            "multipart" => [
                [
                    "name" => "nilai",
                    "contents" => $request->nilai
                ],
                [
                    "name" => "catatan",
                    "contents" => $request->catatan
                ],
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $request->session()->get('token'),
            ],
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/course/task/' . $response['id_assignment'])->with('failed', 'Failed add');
        }
        return redirect('/admin/course/task/' . $response['id_assignment'])->with('success', 'Success add');
    }
}
