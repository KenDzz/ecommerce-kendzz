<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailForgot;
use App\Jobs\SendMailJob;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendMailConfirm($name,$mail,$urlVerify,$view) {
        if (!filter_var(trim($mail), FILTER_VALIDATE_EMAIL)) {
            return response()->json('Invalid email address', 422);
        }

        $dataMail = new \stdClass();
        $dataMail->name = $name;
        $dataMail->email = trim($mail);
        $dataMail->view = $view;
        $dataMail->urlVerify = $urlVerify;
        $dataMail->title = "Xác minh địa chỉ email";
        //send mail queue
        SendMailJob::dispatch($dataMail);
    }

    public function sendMailForgotPassword($name,$mail,$password,$view) {
        if (!filter_var(trim($mail), FILTER_VALIDATE_EMAIL)) {
            return response()->json('Invalid email address', 422);
        }

        $dataMail = new \stdClass();
        $dataMail->name = $name;
        $dataMail->email = trim($mail);
        $dataMail->view = $view;
        $dataMail->password = $password;
        $dataMail->title = "Quên mật khẩu";
        //send mail queue
        SendMailForgot::dispatch($dataMail);
    }

    public function testMail(){
        $this->sendMailConfirm("KenDzz", "vvqua.2x@gmail.com", "", "mail.confirm-email");
    }
}
