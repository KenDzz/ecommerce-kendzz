<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRecharge;
use App\Models\UsersShippingAddresses;
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


    public function addMoney($money){
        $user = User::find(Auth::user()->id);
        if(is_numeric($money) && $money > 0){
            $user->money += $money;
            $user->save();
        }
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
        $userProject = new UserRecharge();
        $userProject->user_id = Auth::user()->id;
        $userProject->trans_id = $tran_id;
        $userProject->amount = $checkInfo['amount'];
        $userProject->message = $message;
        $userProject->bank_code = $checkInfo['code'];
        $userProject->save();
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
        $UserRecharge = UserRecharge::where('trans_id', $checkInfo['id'])->first();
        if($UserRecharge){
            $UserRecharge->code = $resp['code'];
            $UserRecharge->message_callback = $resp['message'];
            $UserRecharge->save();
            if($resp['code'] == 9){
                $this->addMoney($resp['amount']);
            }
       }

        return response()->json($filteredData);
    }

    public function getApiAddress($search,$state,$city,$district){
        $data = [];
        $url = env('API_SPX')."?input=".$search."&country=VN&state=".rawurlencode($state)."&city=".rawurlencode($city)."&district=".rawurlencode($district);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        if($resp != null){
            foreach($resp['data'] as $values)
            {
                $data[] = $values['main_text'].", ".$values['secondary_text'];
            }
        }
        return response()->json($data);
    }

    public function shippingaddresses(){
        $user_id = auth()->user()->id;
        $shippingaddresses = UsersShippingAddresses::where('user_id',$user_id)->get();
        return view("user.addresses", ['datas' => $shippingaddresses]);
    }

}
