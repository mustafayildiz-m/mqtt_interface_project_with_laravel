<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MqttEmailAlertController extends Controller

{
    public function sendEmail(Request $request): \Illuminate\Http\JsonResponse
    {

        try {

            $userEmail = $request->allowed_email;
            $status = Mail::to($userEmail)->send(new SendMail($request->all()));
            if ($status) {
                return response()->json(['message' => 'E-posta gönderildi']);

            }
            return response()->json(['message' => 'E-posta gönderilemedi.']);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }

    }
}



//{
//    message: {
//    parsedObj: {
//      statu: 'trashold',
//      humd: 45.83,
//      temp: 26.83,
//      state: 'alarm',
//      timestamp: 1689948801,
//      connection_type: 1
//    },
//    serial_no: '8659896',
//    allowed_email: 'mustafayildiz.m@gmail.com',
//    deviceLimits: {
//        id: '7',
//      serial_no: '8659896',
//      temp_min: 13,
//      temp_max: 20,
//      crit_temp_min: 15,
//      crit_temp_max: 30,
//      moisture_min: 20,
//      moisture_max: 40,
//      crit_moisture_min: 10,
//      crit_moisture_max: 70,
//      created_at: null,
//      updated_at: null
//    },
//    zone: 'X'
//  }
//}

