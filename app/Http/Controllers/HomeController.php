<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view('product.home');
    }

    public function formatCurrency($amount, $discount)
    {
        if($discount > 0){
            $dis = $amount / $discount;
            $amount = $amount - $dis;
        }
        return number_format($amount, 0, ',', '.') . ' VND';
    }

}
