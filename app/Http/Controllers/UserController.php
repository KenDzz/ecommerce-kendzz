<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function infoUser(){
        $user = Auth::user();
        $phone = $user->phone;
        $email = $user->email;
        if($email != null){
            $email = strlen($email) > 6 ? substr($email, 0, 3) . '............' . substr($email, strlen($email) -8, strlen($email)) : $email;
        }

        if($phone != null){
            $phone = strlen($phone) > 9 ? substr($phone, 0, 5) . '...' .substr($phone, strlen($phone)-3, strlen($phone)) : $phone;
        }
        return view("user.info", ['user' => $user, 'email' => $email, 'phone' => $phone]);
    }


    public function recharge(){
        return view("user.recharge");
    }

    public function getInfoQRPay(Request $request){
        $checkInfo = $request->validate([
            'code' => ['required'],
            'amount' => ['required', 'numeric'],
        ]);
        $tran_id = md5(time());
        $message = Auth::user()->id .  $checkInfo['amount'];
        $url = env('QRPAY_API').'?username='.env('QRPAY_USER').'&password='.env('QRPAY_PASS'). '&bank_code='.$checkInfo['code'].'&amount='.$checkInfo['amount'].'&tran_id='.$tran_id.'&message='.$message;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        $resp['tranid'] = $tran_id;
        return response()->json($resp);

    }

    public function checkqrpay(Request $request){
        $checkInfo = $request->validate([
            'id' => ['required'],
        ]);
        $url = env('QRPAY_CHECK').'?username='.env('QRPAY_USER').'&password='.env('QRPAY_PASS'). '&tran_id='.$checkInfo['id'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        $filteredData = collect($resp)->only(['amount', 'code', 'message'])->toArray();
        return response()->json($filteredData);
    }

}
