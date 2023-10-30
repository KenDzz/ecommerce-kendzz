<?php

namespace App\Http\Controllers;

use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserVerifyController extends Controller
{

    public function emailVerify($userid, $token) {
        $verifyUser = UserVerify::where('user_id', '=', $userid)->where('token', '=', $token)->first();
        $message ="";
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
            }else{
                $message = 'Email của bạn đã được xác minh.';
            }
        }else{
            $message = 'Xin lỗi, email của bạn không thể được xác định.';
        }

      return redirect()->route('auth-login')->with('message', $message);
    }

    public function createUserVerifyEmail($userid) {
        $token = Str::random(64);
        $newUser = UserVerify::create([
            'user_id' => $userid,
            'token' => $token
        ]);
        return route('auth-email-verify', ['userid' => $userid, 'token' => $token]);
    }
}
