<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReviews;
use App\Models\ProductType;
use App\Models\UsersFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $homeController;

    public function __construct(HomeController $homeController) {
        $this->homeController = $homeController;
    }

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


    public function search(Request $request, Product $product){
        $checkInfo = $request->validate([
            'search' => ['required', 'string', 'max:255'],
        ]);
        $productSearch = $product::where('name', 'LIKE', '%' . $checkInfo['search'] . '%')->paginate(12);
        $title = "Tìm kiếm - ".$checkInfo['search'];
        return view("product.search", ["products" => $productSearch, "title" => $title]);
    }

    public function detailProduct($id, $slug){
        $product = Product::where('id',$id)->where('slug',$slug)->firstOrFail();
        $productTypes = $product->productType;
        $DataRecommendations = $product->Recommendations->where('order_column' ,'>', 0)->toArray();
        $targetIds = array_column($DataRecommendations, 'target_id');
        $productRecommendations = Product::whereIn('id', $targetIds)->get();
        $productReviews = ProductReviews::where('product_id', $product->id)->paginate(12);
        $reviewsWithRating1 = $productReviews->where('rate', 1);
        $reviewsWithRating2 = $productReviews->where('rate', 2);
        $reviewsWithRating3 = $productReviews->where('rate', 3);
        $reviewsWithRating4 = $productReviews->where('rate', 4);
        $reviewsWithRating5 = $productReviews->where('rate', 5);
        $data = [
            'product' => $product,
            'productTypes' => $productTypes,
            'productRecommendations' => $productRecommendations,
            'productReviews' => $productReviews ,
            'reviewsWithRating1' => $reviewsWithRating1 ,
            'reviewsWithRating2' => $reviewsWithRating2 ,
            'reviewsWithRating3' => $reviewsWithRating3 ,
            'reviewsWithRating4' => $reviewsWithRating4 ,
            'reviewsWithRating5' => $reviewsWithRating5
        ];

        return view('product.product', $data);
    }

    public function addFavourite(Request $request){
        $checkData = $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        $findF = UsersFavourite::where('product_id', $checkData['id'])->where('user_id', Auth::user()->id)->first();
        if($findF){
            $findF->delete();
            return response()->json(['status' => 'delete']);
        }else{
            $userFavourite = new UsersFavourite();
            $userFavourite->product_id = $checkData['id'];
            $userFavourite->user_id = Auth::user()->id;
            $userFavourite->save();
        }
        return response()->json(['status' => 'add']);
    }

    public function reloadFavourite(){
        $findF = UsersFavourite::where('user_id', Auth::user()->id)->get();
        session()->put('favourite', []);
        $Favourite = session()->get('favourite', []);
        foreach ($findF as $key => $value) {
            $productMedia = $value->products->productMedia->first();
            $image = $productMedia->url;
            $Favourite[$value->id] = [
                "id" => $value->product_id,
                "name" => $value->products->name,
                "link" => route('detail-product', ['slug'=>urlencode($value->products->slug), 'id' => $value->products->id]),
                "image" => $image
            ];
        }
        session()->put('favourite', $Favourite);
        return response()->json(['favourite' => session('favourite')]);
    }

    public function UpdateRecommendationsSimilar(){
        set_time_limit(0);
        Product::generateRecommendations('similar_products');
        return response()->json(['status' => 'success']);
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
        $productType = null;
        $productSize = null;
        if (isset($checkInfo['category']) && !is_null($checkInfo['category'])) {
            $productType = $product->productType->where('id',$checkInfo['category'])->first();
        }else{
            $checkInfo['category'] = "";
        }

        if (isset($checkInfo['size']) && !is_null($checkInfo['size'])) {
            $productSize = $productType->productSize->where('id',$checkInfo['size'])->first();
        }else{
            $checkInfo['size'] = "";
        }
        $price = $product->price;
        if($product->discount > 0){
            $price = $this->homeController->calculateCurrency($product->price, $product->discount);
        }
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
                "category" => $productType != null ? $productType->name : "",
                "size" => $productSize != null ? $productSize->name : "",
                "price" => $price,
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
