<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::all();
        $i = 1;

        return view('users.page.payment.index', compact('data', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.page.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('bukti');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/payment'), $fileName);

        Payment::create([
            "nama" => $request->nama,
            "note" => $request->catatan,
            "bukti" => $fileName,
            "id_user" => 1
        ]);

        return redirect('/payment')->with('success', 'Success add payment');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $payment = Payment::where('id', $id)->first();
        return view('users.page.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data = Payment::where('id', $id)->first();
        return view('users.page.payment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $payment = Payment::find($id);

        if ($payment) {
            if ($request->hasFile('bukti')) {
                unlink(public_path('assets/payment/' .  $payment->bukti));
                $file = $request->file('bukti');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/payment'), $fileName);
                $payment->update([
                    "nama" => $request->nama,
                    "note" => $request->catatan,
                    "bukti" => $fileName,
                ]);
            } else {
                $payment->update($request->all());
            }
        } else {
            return redirect('/payment')->with('failed', 'Cannot found payment with id' . $id . "!");
        }

        return redirect('/payment')->with('success', "Edit data success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->bukti) {
            unlink(public_path('assets/payment/' .  $payment->bukti));
        }

        $payment->delete();

        return redirect('/payment')->with('success', 'Success delete book data!');
    }
}
