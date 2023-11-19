<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Score;
use App\Models\Tingkatan;
use App\Models\User;;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all()->count();

        $assignment = [
            "done" => Score::where('id_user', '=', 1)->where('status', '=', 'selesai')->count(),
            "late" => Score::where('id_user', '=', 1)->where('status', '=', 'terlambat')->count(),
            "notdone" => Score::where('id_user', '=', 1)->where('status', '=', 'belum_selesai')->count(),
        ];

        $username = User::firstWhere('username', 'mallexibra');
        $schedule = Tingkatan::firstWhere('id', $username->id_tingkatan);

        return view('users.page.dashboard.index', compact('schedule', 'assignment', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
