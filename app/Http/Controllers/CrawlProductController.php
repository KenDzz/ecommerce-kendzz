<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductMedia;
use Illuminate\Http\Request;

class CrawlProductController extends Controller
{
    public function getListMenuTiki(){
        $url = env("API_TIKI_MENU")."?platform=desktop";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        $menuList = $resp['menu_block']['items'];
        foreach ($menuList as $key => $value) {
            $urlParts = parse_url($value['link']);
            $path = explode("/", $urlParts['path']);
            $menuList[$key]['urlKey'] = $path[1];
            $menuList[$key]['category'] = preg_replace("/[^0-9]/", "", $path[2]);
        }
        return response()->json($menuList);
    }

    public function getListProductTiki($category, $urlKey, $page = 1, $limit = 40){
        $url = env("API_TIKI_LIST_PRODUCT")."?limit=".$limit."&include=advertisement&aggregations=2&version=home-persionalized&trackity_id=6df93526-59aa-f488-2880-849ea5962708&category=".$category."&page=".$page."&urlKey=".$urlKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        return response()->json($resp['data']);
    }

    public function getDetailProductTiki($id){
        $url = env("API_TIKI_PRODUCT").$id."?platform=web&spid=".$id."&version=3";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        return response()->json($resp);
    }

    public function getProvinces($id){
        $url = "https://provinces.open-api.vn/api/?depth=".$id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        return response()->json($resp);
    }

    public function getCity($id){
        $url = "https://provinces.open-api.vn/api/p/".$id."?depth=2";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        return response()->json($resp);
    }

    public function getDistrict($id){
        $url = "https://provinces.open-api.vn/api/d/".$id."?depth=2";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($output,true);
        return response()->json($resp);
    }

    public function crawlProductTiki($category, $urlKey, $totalPage, $categoryReal){
        $data = [];
        for($i = 1; $i <= $totalPage; $i++){
            $content = $this->getListProductTiki($category, $urlKey, $i, 40)->getData();
            foreach ($content as $key => $value) {
                $productDetail = $this->getDetailProductTiki($value->id)->getData();
                // $product = Product::updateOrInsert(
                //     ['id' => $value->id],
                //     [
                //         'slug' => $productDetail->url_key,
                //         'describes' => $productDetail->description,
                //         'rate' => $productDetail->rating_average,
                //         'name' => $productDetail->name,
                //         'price' => $productDetail->price,
                //         'wholesale_price' => 0,
                //         'wholesale_price_quantity' => 0,
                //         'discount' => $productDetail->discount_rate,
                //         'quantity' => 999,
                //         'monthly_purchases' => 0,
                //         'purchases' => 0,
                //         'weight' => mt_rand() / mt_getrandmax() * 5.5,
                //         'seller_id' => 1,
                //         'category_id' => $categoryReal,
                //     ]
                // );

                $slug = property_exists($productDetail, 'url_key') ? $productDetail->url_key  : Str::slug($productDetail->name);
                $product = Product::firstOrCreate(['id' => $value->id], [
                    'slug' => $slug,
                    'describes' => $productDetail->description,
                    'rate' => $productDetail->rating_average,
                    'name' => $productDetail->name,
                    'price' => $productDetail->price,
                    'wholesale_price' => 0,
                    'wholesale_price_quantity' => 0,
                    'discount' => $productDetail->discount_rate,
                    'quantity' => 999,
                    'monthly_purchases' => 0,
                    'purchases' => 0,
                    'weight' => mt_rand() / mt_getrandmax() * 5.5,
                    'seller_id' => 1,
                    'category_id' => $categoryReal,
                ]);
                if($product){
                    foreach ($productDetail->images as $keyImg => $valueImg) {
                        $productMedia = new ProductMedia();
                        $productMedia->product_id = $value->id;
                        $productMedia->url = $valueImg->base_url;
                        $productMedia->type = 0;
                        $productMedia->save();
                    }
                    $data[] = $productDetail;
                }
            }
        }
        return response()->json($data);
    }

}
