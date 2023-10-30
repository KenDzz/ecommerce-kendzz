<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
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
        $productTypes = $product->productType;
        return view('product.product',['product' => $product, 'productTypes' => $productTypes]);
    }

    public function getSize(Request $request){
        $data = [];
        $data['status'] = false;
        $checkData = $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        $productType = ProductType::where('id',$checkData['id'])->firstOrFail();
        $productSizes = $productType->productSize->map(function ($productSize) {
            return [
                'id' => $productSize->id,
                'name' => $productSize->name,
                'quantity' => $productSize->quantity,
            ];
        });
        if(!$productSizes->isEmpty() && $productSizes->count() > 0){
            $data['status'] = true;
            $data['data'] = $productSizes;
        }
        return response()->json($data);

    }

}
