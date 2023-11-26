<?php

namespace App\Http\Controllers;

use App\Models\ProductReviews;
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
        ]);
        $fileLocation= [];
        foreach ($validated['file'] as $key => $value) {
            $fileLocation[] = Storage::putFile(
                path: 'public/review',
                file: new File(Storage::path($value))
            );
        }
        $productReview = new ProductReviews();
        $productReview->user_id = Auth::user()->id;
        $productReview->product_id = $validated['id'];
        $productReview->comment = $validated['comment'];
        $productReview->rate = $validated['rate'];
        $productReview->img_url = $fileLocation[0];
        $productReview->video_url = $fileLocation[1] ?? "" ;
        if($productReview->save()){
            return response()->json(["status" => "true"], 200);
        }
        return response()->json(["status" => "false","message" => "Thất bại! Vui lòng thử lại"], 422);
    }
}
