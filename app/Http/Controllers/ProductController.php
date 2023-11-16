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

    public function addToCart(Request $request){
        $data['status'] = false;
        $checkInfo = $request->validate([
            'id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'category' => [],
            'size' => [],
        ]);
        $product = Product::findOrFail($checkInfo['id']);
        $productType = $product->productType->where('id',$checkInfo['category'])->first();
        $productSize = $productType->productSize->where('id',$checkInfo['size'])->first();

        $cart = session()->get('cart', []);
        $id = $checkInfo['id'].$checkInfo['category'].$checkInfo['size'];
        $productMedia = $product->productMedia->first();
        $image = $productMedia->url;
        if($productType && $productType->count() > 0){
            $image = $productType->img_url;
        }
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $checkInfo['quantity'];
            $data['status'] = true;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $checkInfo['quantity'],
                "category" => $productType->name,
                "size" => $productSize != null ? $productSize->name : "",
                "price" => $product->price,
                "image" => $image
            ];
            $data['status'] = true;
        }
        session()->put('cart', $cart);
        return response()->json($data);

    }

    public function removeToCart(Request $request)
    {
        $data['status'] = false;
        $checkInfo = $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        if($checkInfo['id']) {
            $cart = session()->get('cart');
            if(isset($cart[$checkInfo['id']])) {
                unset($cart[$checkInfo['id']]);
                session()->put('cart', $cart);
            }
            $data['status'] = true;
        }
        return response()->json($data);
    }

    public function removeToCartAll()
    {
        $cart = session()->get('cart');
        if(isset($cart)) {
            $cart = []; 
            session()->put('cart', $cart);
        }
    }

    public function reloadCart(){
        return response()->json(['cart' => session('cart')]);
    }

}
