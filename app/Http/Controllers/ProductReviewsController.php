<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReviews;
use App\Models\UsersOrder;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductReviewsController extends Controller
{
    public function addReview(Request $request){
        $validated = $request->validate([
            'id' => ['required', 'numeric'],
            'file' => ['required'],
            'rate' => ['required', 'numeric'],
            'comment' => ['required', 'string'],
            'oderID' => ['required', 'numeric'],
        ]);
        $fileLocation= [];
        foreach ($validated['file'] as $key => $value) {
            $fileLocation[] = Storage::putFile(
                path: 'public/review',
                file: new File(Storage::path($value))
            );
        }
        $order = UsersOrder::where('id', $validated['oderID'])->first();
        if($order){
            if($order->is_review){
                return response()->json(["status" => "false","message" => "Sản phẩm đã được đánh giá"], 422);
            }
            $productReview = new ProductReviews();
            $productReview->user_id = Auth::user()->id;
            $productReview->product_id = $validated['id'];
            $productReview->comment = $validated['comment'];
            $productReview->rate = $validated['rate'];
            $productReview->img_url = $fileLocation[0] ?? "";
            $productReview->video_url = $fileLocation[1] ?? "" ;
            $order->is_review = true;
            if($productReview->save() && $order->save()){
                return response()->json(["status" => "true"], 200);
            }
        }
        return response()->json(["status" => "false","message" => "Thất bại! Vui lòng thử lại"], 422);
    }
}
