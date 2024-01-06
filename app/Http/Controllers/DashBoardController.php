<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{

    private $fileUpload;

    private $checkBadWords;

    public function __construct(FileUploadController $upload, CheckBadWordsController $checkBadWordsController) {
        $this->fileUpload = $upload;
        $this->checkBadWords = $checkBadWordsController;
    }

    public function index(){
        return view('dashboard.layout');
    }

    public function chat(){
        return view('dashboard.chat');
    }

    public function productView(){
        $products = Product::where('seller_id', Auth::user()->seller->id)->get();
        return view('dashboard.product', ['products' => $products]);
    }


    public function productAdd(){
        $category = Category::all();
        return view('dashboard.addproduct', ['category' => $category]);
    }

    public function productUpadte($id){
        if(is_numeric($id)){
            $product = Product::where('id', $id)->first();
            $category = Category::all();
            return view("dashboard.detailproduct", ['product' => $product, 'categorys' =>$category]);
        }else{
            return abort(404);
        }
    }

    public function productUpadteAdmin($id){
        if(is_numeric($id)){
            $product = Product::where('id', $id)->first();
            $category = Category::all();
            if($product && $product->count() > 0){
                $checkName  = $this->checkBadWords->checkBadWordStringArr($product->name);
                $checkDesc  = $this->checkBadWords->checkBadWordStringArr($product->describes);
                $arr = array_merge($checkName,$checkDesc);

            }
            return view("dashboard.admin.product.detail", ['product' => $product, 'categorys' =>$category, 'badwords' => $arr]);
        }else{
            return abort(404);
        }
    }

    public function productUpadteConfirmAdmin($id,$status){
        if(is_numeric($id) && is_numeric($status) ){
            $product = Product::where('id', $id)->first();
            if($product && $product->count() > 0){
                $product->is_confirm = $status;
                $product->save();
            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function productViewAdmin($id){
        if(is_numeric($id)){
            if($id == 4){
                $product = Product::all();
            }else if($id == 1){
                $product = Product::where('is_confirm', $id)->get();
            }else if($id == 2){
                $product = Product::where('is_confirm', $id)->get();

            }else if($id == 3){
                $product = Product::where('is_confirm', $id)->get();
            }else{
                return abort(404);
            }
            return view("dashboard.admin.product.product", ['products' => $product]);
        }else{
            return abort(404);
        }
    }

    public function addMediaProduct(Request $request){
        $checkInfo = $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $result = false;
        $path = "";
        $data = $this->fileUpload->storeImageUpload($request);
        if($data != ""){
            $productMedia = new ProductMedia();
            $productMedia->product_id = $checkInfo['id'];
            $productMedia->url = $data;
            $productMedia->type = 0;
            $productMedia->save();
            $result = true;
            $path = $data;
        }
        return response()->json(['result' => $result, 'path' => $path, 'id' => $productMedia->id]);
    }

    public function delMediaProduct(Request $request){
        $checkInfo = $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $result = false;
        $productMedia = ProductMedia::where('id',$checkInfo['id'])->first();
        if($productMedia && $productMedia->count() > 0){
            $productID = $productMedia->product_id;
            $productMedia->delete();
            $result = true;
        }
        $productMediaList = ProductMedia::where('product_id', $productID)->get();
        return response()->json(['result' => $result, 'data' => $productMediaList]);
    }

    public function productAddForm(Request $request){
        $checkInfo = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'discount' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'category' => ['required', 'numeric'],
            'describes' => ['required']
        ]);
        $result = false;
        if($checkInfo['discount'] > 100){
            return response()->json(['result' => $result]);
        }

        $product = new Product();
        $product->name = $checkInfo['name'];
        $product->describes = $checkInfo['describes'];
        $product->seller_id = Auth::user()->seller->id;
        $product->rate = 0;
        $product->price = $checkInfo['price'];
        $product->category_id = $checkInfo['category'];
        $product->wholesale_price = 0;
        $product->wholesale_price_quantity = 0;
        $product->discount = $checkInfo['discount'];
        $product->quantity = $checkInfo['quantity'];
        $product->monthly_purchases = 0;
        $product->purchases = 0;
        $product->is_confirm = 1;
        $product->weight = $checkInfo['weight'];
        if($product->save()){
            $result = true;
        }
        return response()->json(['result' => $result, 'id' => $product->id]);
    }

}
