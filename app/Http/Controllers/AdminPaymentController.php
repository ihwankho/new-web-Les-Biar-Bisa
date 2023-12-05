<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");

        $data = json_decode($client->request("GET", $url . '/payments')->getBody(), true)['data'];

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item['created_at'];
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.index', compact('data', 'i', 'dateTime'));
    }

    public function come()
    {
        $client = new Client();
        $url = env("API_URL");

        $datas = json_decode($client->request("GET", $url . "/payments")->getBody(), true)['data'];
        $data = collect([]);

        foreach ($datas as $dt) {
            if ($dt['status'] == "pending") {
                $data->push($dt);
            }
        }

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item['created_at'];
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.come', compact('data', 'i', 'dateTime'));
    }

    public function approved()
    {
        $client = new Client();
        $url = env("API_URL");

        $datas = json_decode($client->request("GET", $url . "/payments")->getBody(), true)['data'];
        $data = collect([]);

        foreach ($datas as $dt) {
            if ($dt['status'] == "approved") {
                $data->push($dt);
            }
        }

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item['created_at'];
            $date = new DateTime($dateString);
            $formattedDate = $date->format('d F Y');

            $dateTime->push($formattedDate);
        }

        return view('admin.page.payment.approved', compact('data', 'i', 'dateTime'));
    }

    public function unapproved()
    {
        $client = new Client();
        $url = env("API_URL");

        $datas = json_decode($client->request("GET", $url . "/payments")->getBody(), true)['data'];
        $data = collect([]);

        foreach ($datas as $dt) {
            if ($dt['status'] == "unapproved") {
                $data->push($dt);
            }
        }

        $i = 1;

        $dateTime = collect([]);
        foreach ($data as $item) {
            $dateString = $item['created_at'];
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
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/payments/" . $id, [
            "multipart" => [
                [
                    "name" => "status",
                    "contents" => "approved"
                ]
            ]
        ])->getBody(), true)['status'];

        if ($response) {
            return redirect("/admin/payment");
        } else {
            return redirect("/admin/payment");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/payments/" . $id, [
            "multipart" => [
                [
                    "name" => "status",
                    "contents" => "unapproved"
                ]
            ]
        ])->getBody(), true)['status'];

        if ($response) {
            return redirect("/admin/payment");
        } else {
            return redirect("/admin/payment");
        }
    }
}
