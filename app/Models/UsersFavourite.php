<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersFavourite extends Model
{
    use HasFactory;

    public $table = "users_favourite";

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
