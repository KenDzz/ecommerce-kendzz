<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Umutphp\LaravelModelRecommendation\InteractWithRecommendation;
use Umutphp\LaravelModelRecommendation\HasRecommendation;

class Product extends Model  implements InteractWithRecommendation
{
    use HasFactory, HasRecommendation;

    public $table = "product";

    protected $fillable = [
        'id',
        'name',
        'slug',
        'describes',
        'seller_id',
        'rate',
        'price',
        'category_id',
        'wholesale_price',
        'wholesale_price_quantity',
        'discount',
        'quantity',
        'monthly_purchases',
        'purchases',
        'weight'
    ];

    public static function getRecommendationConfig() :array
    {
        return [
            'similar_products' => [
                'recommendation_algorithm'            => 'similarity',
                'similarity_feature_weight'           => 1,
                'similarity_numeric_value_weight'     => 1,
                'similarity_numeric_value_high_range' => 1,
                'similarity_taxonomy_weight'          => 1,
                'similarity_feature_attributes'       => [
                    'rate'
                ],
                'similarity_numeric_value_attributes' => [
                    'price'
                ],
                'similarity_taxonomy_attributes'      => [
                    [
                        'category' => "name",
                    ]
                ],
                'recommendation_count'                => 2,
                'recommendation_order'                => 'desc'
            ]
        ];
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productMedia(){
        return $this->hasMany(ProductMedia::class, 'product_id');
    }

    public function productType(){
        return $this->hasMany(ProductType::class, 'product_id');
    }

    public function UsersOrder(){
        return $this->hasMany(UsersOrder::class, 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getStarRating()
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
