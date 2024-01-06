<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $idUser = request('id-user');

            if ($idUser != null) {
                $payments = Payment::with('users')->where('id_user', '=', $idUser)->get();
            } else {
                $payments = Payment::with('users')->get();
            }

            for ($i = 0; $i < $payments->count(); $i++) {
                $payments[$i]['bukti'] = url("/assets/payment/" . $payments[$i]['bukti']);
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data payments successfully",
                "data" => $payments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function show(String $id)
    {
        try {
            $payment = Payment::findOrFail($id);


            $payment['bukti'] = url("/assets/payment/" . $payment['bukti']);


            return response()->json([
                "status" => true,
                "message" => "GET data payment by id successfully",
                "data" => $payment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                "nama" => "required",
                "note" => "required",
                "bukti" => "required|image|mimes:jpeg,jpg,png",
                "id_user" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()->all()
                ]);
            }

            $fileName = null;
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('/assets/payment'), $fileName);
            }

            Payment::create([
                "nama" => $request->nama,
                "note" => $request->note,
                "bukti" => $fileName,
                "id_user" => $request->id_user,
            ]);

            return response()->json([
                "status" => true,
                "message" => "ADD data payment successfully",
                "data_updated" => [
                    "nama" => $request->nama,
                    "note" => $request->note,
                    "bukti" => $fileName,
                    "id_user" => $request->id_user,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $payment = Payment::findOrFail($id);

            $fileName = $payment->bukti;
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                unlink(public_path('/assets/payment/' . $fileName));
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('/assets/payment'), $fileName);
            }

            $nama = $payment->nama;
            if ($request->nama) {
                $nama = $request->nama;
            }

            $status = $payment->status;
            if ($request->status) {
                $status = $request->status;
            }

            $note = $payment->note;
            if ($request->note) {
                $note = $request->note;
            }

            $payment->update([
                "nama" => $nama,
                "status" => $status,
                "note" => $note,
                "bukti" => $fileName,
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data payment successfully",
                "data_updated" => [
                    "nama" => $request->nama,
                    "note" => $request->note,
                    "bukti" => $fileName,
                    "id_user" => $request->id_user,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy(String $id)
    {
        try {

            $payment = Payment::findOrFail($id);

            unlink(public_path('/assets/payment/' . $payment->bukti));

            $payment->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data payment by id successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
