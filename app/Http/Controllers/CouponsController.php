<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function checkCouponsRequest(Request $request) {
        $checkData = $request->validate([
            'id' => ['required', 'string', 'max:50'],
        ]);

        $result = $this->checkCoupons($checkData['id']);
        return response()->json($result);
    }

    public function checkCoupons($id){
        $data['status'] = true;
        $coupons = Coupons::where('id', $id)->first();
        if(!$coupons || $coupons->count == 0 || $coupons->count < -1 || $coupons->is_exit || !$coupons->isExpired()){
            $data['status'] = false;
        }else{
            $data['data'] = $coupons;
            $data['validate'] = $coupons->timeRemaining();
        }
        return $data;
    }

}
