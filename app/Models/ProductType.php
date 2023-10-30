<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    public $table = "product_type";


    protected $fillable = [
        'product_id',
        'name',
        'quantity',
        'type',
        'img_url',
    ];

    public $timestamps = false;

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productSize(){
        return $this->hasMany(ProductSize::class, 'type_id');
    }

}
