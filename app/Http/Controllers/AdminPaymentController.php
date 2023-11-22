<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use DateTime;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::with('users')->get();

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item->created_at;
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.index', compact('data', 'i', 'dateTime'));
    }

    public function come()
    {
        $data = Payment::where('status', '=', 'pending')->with('users')->get();

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item->created_at;
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.come', compact('data', 'i', 'dateTime'));
    }

    public function approved()
    {
        $data = Payment::where('status', '=', 'approved')->get();

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item->created_at;
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.approved', compact('data', 'i', 'dateTime'));
    }

    public function unapproved()
    {
        $data = Payment::where('status', '=', 'unapproved')->get();

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item->created_at;
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.unapproved', compact('data', 'i', 'dateTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            "status" => "approved"
        ]);

        return redirect("/admin/payment");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            "status" => "unapproved"
        ]);

        return redirect("/admin/payment");
    }
}
