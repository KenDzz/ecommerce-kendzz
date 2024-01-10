<?php

namespace App\Http\Controllers;

use App\Models\Eky;
use App\Models\EkyMedia;
use App\Models\logEkyc;
use App\Models\Seller;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    private $sms;
    private $fileUpload;


    public function __construct(SMSController $sms, FileUploadController $upload) {
        $this->fileUpload = $upload;
        $this->sms = $sms;
    }

    public function addSeller(Request $request){
        $checkSeller = $request->validate([
            'lastname' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'unique:seller'],
            'name'  => ['required', 'string'],
            'province'  => ['required', 'string'],
            'city'  => ['required', 'string'],
            'district'  => ['required', 'string'],
            'address'  => ['required', 'string'],
            'postalcode'  => [],
        ]);
        $seller = new Seller();
        $seller->user_id = Auth::user()->id;
        $seller->name = $checkSeller['name'];
        $seller->first_name = $checkSeller['firstname'];
        $seller->last_name = $checkSeller['lastname'];
        $seller->describe = "";
        $seller->rate = 0;
        $seller->address = $checkSeller['address'];
        $seller->district = $checkSeller['district'];
        $seller->city = $checkSeller['city'];
        $seller->province = $checkSeller['province'];
        $seller->postalcode = $checkSeller['postalcode'];
        $seller->phone = $checkSeller['phone'];
        $seller->is_verified = 0;
        if($seller->save()){
            $otp = rand(100000, 999999);
            $verifyUser = UserVerify::where('user_id', '=', Auth::user()->id)->first();
            $verifyUser->otp = $otp;
            $verifyUser->save();
            $phoneSeller  = "+84".$seller->phone;
            $content = "OTP của bạn là ".$otp;
            //$this->sms->sendSMS($phoneSeller, $content);
            return response()->json(["status" => "true"], 200);
        }
        return response()->json(["status" => "false","message" => "Vui lòng nhập"], 422);
    }


    public function addEkyc(Request $request){
        $checkEkyc = $request->validate([
            'name' => ['required', 'string'],
            'numbercmnd' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'name'  => ['required', 'string'],
            'sex'  => ['required', 'numeric'],
            'addressone'  => ['required', 'string'],
            'addresssecond'  => ['required', 'string'],
        ]);

        $ekyc = new Eky();
        $ekyc->seller_id = Auth::user()->seller->id;
        $ekyc->name = $checkEkyc['name'];
        $ekyc->code = $checkEkyc['numbercmnd'];
        $ekyc->birthday = $checkEkyc['birthday'];
        $ekyc->sex = $checkEkyc['sex'];
        $ekyc->addressone = $checkEkyc['addressone'];
        $ekyc->addresssecond = $checkEkyc['addresssecond'];
        if($ekyc->save()){
            return response()->json(["status" => true], 200);
        }
        return response()->json(["status" => false,"message" => "Lỗi hệ thống!"], 422);
    }

    public function addFace(Request $request){
        $result = false;
        $path = "";
        $data = $this->fileUpload->storeImageUpload($request);
        if($data != ""){
            $ekycMedia = new EkyMedia();
            $ekycMedia->seller_id = Auth::user()->seller->id;
            $ekycMedia->url = $data;
            $ekycMedia->type = 4;
            $ekycMedia->save();
            $result = true;
            $path = $data;
        }
        return response()->json(['result' => $result, 'path' => $path]);
    }


    public function logSeller(Request $request){
        $requestDate = $request->all();
        $log = new logEkyc();
        $log->seller_id = Auth::user()->seller->id;
        $log->text = implode("|",$requestDate['text']);
        $log->save();
        $data = [
            ['seller_id'=> Auth::user()->seller->id, 'url'=> $requestDate['imagecrop'], 'type' => 0],
            ['seller_id'=> Auth::user()->seller->id, 'url'=> $requestDate['imagetextorc'], 'type' => 1],
            ['seller_id'=> Auth::user()->seller->id, 'url'=> $requestDate['imageupload'], 'type' => 2],
        ];
        foreach ($requestDate['imagetextcrop'] as $key => $value) {
            $data[] = ['seller_id'=> Auth::user()->seller->id, 'url'=> $value, 'type' => 3];
        }
        EkyMedia::insert($data);
    }

    public function verifiedSeller(Request $request){
        $check = $request->validate([
            'otp' => ['required', 'numeric'],
        ]);
        $verifyUser = UserVerify::where('user_id', Auth::user()->id)->first();
        $now = Carbon::now()->timestamp;
        $dateUpdate = $verifyUser->updated_at->timestamp;
        $updatedTimestampWith15Minutes = Carbon::createFromTimestamp($dateUpdate)->addMinutes(15)->timestamp;
        if($now <= $updatedTimestampWith15Minutes){
            if($verifyUser->otp == $check['otp']){
                return response()->json(["status" => "true"], 200);
            }else{
                return response()->json(["status" => "false","message" => "Mã OTP không chính xác"], 422);

            }
        }
        return response()->json(["status" => "false","message" => "Mã OTP hết hạn"], 422);
    }
}
