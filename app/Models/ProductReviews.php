<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    use HasFactory;

    public $table = "product_reviews";


    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'rate',
        'img_url',
        'video_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStarRatingReview()
    {
        $stars = '';
        $fullStars = floor($this->rate); // Số lượng stars đầy (integer)
        $halfStar = ceil($this->rate) - $fullStars; // Kiểm tra nếu có 0.5 star

        // Thêm full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '<ion-icon name="star"></ion-icon>';
        }

        // Thêm half star nếu có
        if ($halfStar > 0) {
            $stars .= '<ion-icon name="star-half"></ion-icon>';
        }

        // Thêm empty stars cho đến khi đủ 5 stars
        for ($i = 0; $i < (5 - $fullStars - $halfStar); $i++) {
            $stars .= '<ion-icon name="star-outline"></ion-icon>';
        }

        return $stars;
    }

}
