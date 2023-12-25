<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LogClick;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $dataProduct = [];
        $lisLogClickProduct = LogClick::where('user_id', 0)->orderBy('created_at', 'DESC')->limit(3)->get();
        if(Auth::check()){
            $lisLogClickProduct = LogClick::where('user_id', Auth::user()->id)->orderBy('created_at' , 'DESC')->limit(3)->get();
        }
        if($lisLogClickProduct && $lisLogClickProduct->count() > 2){
            foreach ($lisLogClickProduct as $key => $data) {
                $DataRecommendations = $data->product->Recommendations->where('order_column' ,'>', 0)->toArray();
                $targetIds = array_column($DataRecommendations, 'target_id');
                $dataProduct = array_merge($dataProduct, $targetIds);
            }
            $products  = Product::whereIn('id', $dataProduct)->limit(12)->get();
        }else{
            $products = Product::inRandomOrder()->limit(12)->get();
        }
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
