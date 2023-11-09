<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersShippingAddresses extends Model
{
    use HasFactory;

    public $table = "users_shipping_addresses";

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'province',
        'district',
        'postalcode',
        'name',
        'note',
        'is_used'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getIsUsed()
    {
        $IsUsed = '<div class="h-2.5 w-2.5 rounded-full bg-red-500"></div>';


        if($this->is_used){
            $IsUsed = '<div class="h-2.5 w-2.5 rounded-full bg-green-500">';
        }

        return $IsUsed;
    }
}
