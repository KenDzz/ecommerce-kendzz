<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $products = Product::limit(12)->get();
        $data = ['products' => $products];
        return view('product.home',$data);
    }

    public function formatCurrency($amount, $discount)
    {
        if($discount > 0){
            $dis = ($amount * ($discount / 100));
            $amount = $amount - $dis;
        }
        return number_format($amount, 0, ',', '.') . ' VND';
    }

    public function calculateCurrency($amount, $discount)
    {
        if($discount > 0){
            $dis = ($amount * ($discount / 100));
            $amount = $amount - $dis;
        }
        return $amount;
    }


}
