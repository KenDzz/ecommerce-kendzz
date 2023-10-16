<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function categoryProduct($id){
        if(is_numeric($id)){
            $products = Product::where('category_id',$id)->paginate(12);
            $category  = Category::where('id',$id)->first();
            $data = ['products' => $products, 'title' => $category->name];
            return view('product.category',$data);
        }else{
            return view('layouts.Error.404');
        }
    }


    public function detailProduct($id, $slug){
        $product = Product::where('id',$id)->where('slug',$slug)->firstOrFail();
        return view('product.product',['product' => $product]);
    }

}
