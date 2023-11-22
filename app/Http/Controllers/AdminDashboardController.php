<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Score;
use App\Models\Tingkatan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $i = 1;
        $data = [
            "active_student" => User::all()->count(),
            "new_assignment" => Score::where('nilai', '!=', null)->count(),
            "payment" => Payment::where('status', '!=', 'pending')->count(),
            "schedule" => Tingkatan::all(),
            "students" => User::with('tingkatan')->get()
        ];

        return view('admin.page.dashboard.index', compact('data', 'i'));
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
