<?php

namespace App\Http\Controllers;

use App\Models\Tingkatan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $i = 1;
        $data = User::with('tingkatan')->get();

        return view('admin.page.account.index', compact('data', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tingkatan = Tingkatan::all();

        return view('admin.page.account.create', compact('tingkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = bcrypt($request->password);

        User::create([
            "username" => $request->username,
            "fullname" => $request->fullname,
            "password" => $password,
            "id_tingkatan" => $request->tingkatan,
        ]);

        return redirect('/admin/account')->with('success', 'Success create account');
    }

    public function edit(string $id)
    {
        $users = User::findOrFail($id);

        $tingkatan = Tingkatan::all();

        return view('admin.page.account.edit', compact('users', 'tingkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $password = $user->password;

        if ($request->password) {
            $password = bcrypt($request->password);
        }

        $user->update([
            "username" => $request->username,
            "fullname" => $request->fullname,
            "password" => $password,
            "tingkatan" => $request->tingkatan,
        ]);

        return redirect('/admin/account')->with('success', 'Success update account');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('/admin/account')->with('success', 'Success delete account');
    }
}
