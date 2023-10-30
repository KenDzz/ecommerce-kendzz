<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    public $table = "product_size";


    protected $fillable = [
        'type_id',
        'name',
        'quantity',
        'img_url',
        'type',
    ];

    public function productType(){
        return $this->belongsTo(ProductType::class, 'type_id');
    }
    public $timestamps = false;
}
