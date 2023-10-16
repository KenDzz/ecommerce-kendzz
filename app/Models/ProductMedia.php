<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    use HasFactory;

    public $table = "product_media";


    protected $fillable = [
        'product_id',
        'url',
        'type',
    ];

    public $timestamps = false;

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
