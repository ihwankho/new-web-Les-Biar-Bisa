<?php

namespace App\Http\Controllers;

use App\Models\Tingkatan;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = User::firstWhere('username', 'mallexibra');
        $schedule = Tingkatan::firstWhere('id', $username->id_tingkatan);

        return view('users.page.schedule.index', compact('schedule'));
    }

    public function admin()
    {
        $schedule = Tingkatan::all();

        $data = collect([]);

        foreach ($schedule as $sch) {
            $nama = "";
            $schedule = "";
            if ($sch->nama == "SD") {
                $nama = "Schedule Sekolah Dasar";
                $schedule = $sch->jadwal;
            } else if ($sch->nama == "SMP") {
                $nama = "Schedule Sekolah Menengah Pertama";
                $schedule = $sch->jadwal;
            } else if ($sch->nama == "SMA") {
                $nama = "Schedule Sekolah Menengah Atas";
                $schedule = $sch->jadwal;
            }

            $item = [
                "id" => $sch->id,
                "nama" => $nama,
                "schedule" => $schedule
            ];

            $data->push($item);
        }

        return view('admin.page.schedule.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('jadwal');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('/assets/schedule/'), $fileName);

        Tingkatan::create([
            "nama" => $request->tingkatan,
            "jadwal" => $fileName
        ]);

        return redirect('/admin/schedule')->with('success', 'Success add schedule');;
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
        $schedule = Tingkatan::findOrFail($id);

        return view('admin.page.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $schedule = Tingkatan::findOrFail($id);

        $fileName = $schedule->jadwal;
        if ($request->file('jadwal')) {
            unlink(public_path('/assets/schedule/' . $fileName));
            $file = $request->file('jadwal');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/assets/schedule'), $fileName);

            $schedule->update([
                "nama" => $request->nama,
                "jadwal" => $fileName,
            ]);
        } else {
            $schedule->update($request->all());
        }

        return redirect('/admin/schedule')->with('success', 'Success change schedule');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Tingkatan::findOrFail($id);

        if ($schedule) {
            unlink(public_path('/assets/schedule/' . $schedule->jadwal));
        }

        $schedule->delete();

        return redirect('/admin/schedule')->with('success', "Success delete schedule");
    }
}
