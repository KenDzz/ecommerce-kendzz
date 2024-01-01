<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSaleTimer extends Model
{
    use HasFactory;

    public $table = "product_sale_timer";


    protected $fillable = [
        'product_id',
        'discount',
        'date',
        'h',
        'm',
        's',
        'is_exist'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
