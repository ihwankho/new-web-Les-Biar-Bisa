<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.schedule.index');
    }
}
