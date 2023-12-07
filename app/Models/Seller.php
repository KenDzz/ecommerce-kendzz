<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    public $table = "seller";

    protected $fillable = [
        'user_id',
        'name',
        'describe',
        'rate',
        'address',
        'district',
        'city',
        'province',
        'postalcode',
        'logo'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
