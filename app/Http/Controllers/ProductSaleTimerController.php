<?php

namespace App\Http\Controllers;

use App\Models\ProductSaleTimer;
use Illuminate\Http\Request;

class ProductSaleTimerController extends Controller
{
    public function getAllSale(){
        //$data = [];
        $productSale = ProductSaleTimer::all();
        // foreach ($productSale as $key => $value) {
        //     $data[$key] = $value;
        //     $data[$key]['product'] = $value->product;
        //     $data[$key]['media'] = $value->product->productMedia;
        // }

        return response()->json($productSale);

    }
}
