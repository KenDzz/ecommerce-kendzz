<?php

namespace App\Http\Controllers;

use App\Models\LogClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function logClick($idProduct)
    {
        $log = new LogClick();
        $userID = 0;
        if(Auth::check()){
            $userID = Auth::user()->id;
        }
        $log->user_id = $userID;
        $log->product_id = $idProduct;
        if($log->save()){
            return true;
        }
        return false;
    }
}
