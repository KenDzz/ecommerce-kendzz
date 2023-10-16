<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function sendSMS($receiverNumber,  $message)
    {
        //$receiverNumber = "+84822431739";
        //$message = "Mã OTP của bạn là 4163";

        try {

            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_TOKEN');
            $twilio_number = env('TWILIO_FROM');

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
