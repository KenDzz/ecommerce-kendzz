<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ProductSaleTimer;
use Illuminate\Http\Request;

class ProductSaleTimerController extends Controller
{

    private $homeController;

    public function __construct(HomeController $homeController) {
        $this->homeController = $homeController;
    }

    public function getAllSale(){
        $data = [];
        $now = Carbon::now()->timestamp;
        $productSale = ProductSaleTimer::all();
        foreach ($productSale as $key => $value) {
            $timeString = $value->date.' '.$value->h.':'.$value->m.':'.$value->s;
            list($date, $time) = explode(' ', $timeString);

            list($hour, $minute, $second) = array_pad(explode(':', $time), 3, 0);

            $formattedTimeString = sprintf('%s %02d:%02d:%02d', $date, $hour, $minute, $second);
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $formattedTimeString);
            $timestampStart = $start->timestamp;
            if($now < $timestampStart){
                $data[] =  $value;
            }else{
                $value->is_exist = false;
                $value->save();
            }
        }

        return response()->json($data);

    }

    public function checkSale($productID){
        $price = 0;
        $dataSale = ProductSaleTimer::where('product_id',$productID)->where('is_exist', true)->first();
        $now = Carbon::now()->timestamp;
        if($dataSale && $dataSale->count() > 0){
            $timeString = $dataSale->date.' '.$dataSale->h.':'.$dataSale->m.':'.$dataSale->s;
            list($date, $time) = explode(' ', $timeString);
            list($hour, $minute, $second) = array_pad(explode(':', $time), 3, 0);
            $formattedTimeString = sprintf('%s %02d:%02d:%02d', $date, $hour, $minute, $second);
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $formattedTimeString);
            $timestampStart = $start->timestamp;
            if($now <= $timestampStart){
                $price = $this->homeController->calculateCurrency($dataSale->product->price, $dataSale->discount);
            }
        }
        return $price;
    }

    public function getSale($productID){
        $discount = 0;
        $dataSale = ProductSaleTimer::where('product_id',$productID)->where('is_exist', true)->first();
        $now = Carbon::now()->timestamp;
        if($dataSale && $dataSale->count() > 0){
            $timeString = $dataSale->date.' '.$dataSale->h.':'.$dataSale->m.':'.$dataSale->s;
            list($date, $time) = explode(' ', $timeString);
            list($hour, $minute, $second) = array_pad(explode(':', $time), 3, 0);
            $formattedTimeString = sprintf('%s %02d:%02d:%02d', $date, $hour, $minute, $second);
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $formattedTimeString);
            $timestampStart = $start->timestamp;
            if($now <= $timestampStart){
                $discount =  $dataSale->discount;
            }
        }
        return $discount;
    }
}
