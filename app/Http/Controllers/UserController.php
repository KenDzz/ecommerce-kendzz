<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class UserController extends Controller
{
    private $userVerify;
    private $mail;

    public function __construct()
    {
        $this->userVerify = new UserVerifyController();
        $this->mail = new EmailController();
    }

    public function addUser(Request $request) {
        $checkUser = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'password' => ['required']
        ]);

        $user = new User();
        $user->name = $checkUser['name'];
        $user->email = $checkUser['email'];
        $user->phone = $checkUser['phone'];
        $user->password = bcrypt($checkUser['password']);
        $user->permission_id = 1;

        if($user->save()){
            $urlVerify = $this->userVerify->createUserVerifyEmail($user->id);
            $this->mail->sendMailConfirm($user->name, $user->email, $urlVerify, "mail.confirm-email");
            return response()->json(["status" => "true","message" => "Đăng ký thàng công"], 200);

        }else{
            return response()->json(["status" => "false","message" => "Lỗi hệ thống!"], 422);
        }
    }

}
