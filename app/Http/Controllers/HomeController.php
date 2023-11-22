<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        Product::generateRecommendations('sold_together');
        $products = Product::limit(12)->get();
       //$product1 = Product::find(1);
        //dd($product1->getRecommendations('similar_products'));

        $data = ['products' => $products];
        return view('product.home',$data);
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
