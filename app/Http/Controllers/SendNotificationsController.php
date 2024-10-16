<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendNotificationsController extends Controller
{
    public function sendnotification(Request $request, $notification){
        if($notification == "quiz") {

        }elseif ($notification == "materi") {
            # code...
        }
    }
}
