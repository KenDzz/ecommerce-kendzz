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

}
