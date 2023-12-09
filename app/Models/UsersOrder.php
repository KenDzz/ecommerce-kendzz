<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersOrder extends Model
{
    use HasFactory;

    public $table = "users_order";

    protected $fillable = [
        'user_id',
        'product_id',
        'users_shipping_address_id',
        'cost_shipping',
        'total_price',
        'shipping_code',
        'transporters',
        'describes',
        'quantity',
        'url_img',
        'is_review',
        'coupons_id'
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function Coupons(){
        return $this->belongsTo(Coupons::class, 'coupons_id');
    }

}
