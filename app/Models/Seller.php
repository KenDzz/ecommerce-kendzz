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
        'first_name',
        'last_name',
        'describe',
        'rate',
        'address',
        'district',
        'city',
        'province',
        'postalcode',
        'phone',
        'logo',
        'is_verified'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ekyc()
    {
        return $this->hasMany(Eky::class, 'seller_id');
    }

    public function ekycMedia(){
        return $this->hasMany(EkyMedia::class, 'seller_id');
    }

    public function logEkyc(){
        return $this->hasMany(logEkyc::class, 'seller_id');
    }
}
