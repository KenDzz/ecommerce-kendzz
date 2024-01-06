<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LogClick;
use App\Models\Product;
use App\Models\ProductSaleTimer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $dataSale = [];
        $now = Carbon::now()->timestamp;
        $productSale = ProductSaleTimer::where('is_exist', true)->get();
        foreach ($productSale as $key => $value) {
            $timeString = $value->date.' '.$value->h.':'.$value->m.':'.$value->s;
            list($date, $time) = explode(' ', $timeString);
            list($hour, $minute, $second) = array_pad(explode(':', $time), 3, 0);
            $formattedTimeString = sprintf('%s %02d:%02d:%02d', $date, $hour, $minute, $second);
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $formattedTimeString);
            $timestampStart = $start->timestamp;
            if($now < $timestampStart){
                $dataSale[] =  $value;
            }
        }
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
            $products = Product::where('is_confirm','2')->inRandomOrder()->limit(12)->get();
        }
        $data = ['products' => $products, 'sale' => $dataSale];
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
