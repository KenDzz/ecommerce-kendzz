<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eky extends Model
{
    use HasFactory;

    public $table = "ekyc";

    protected $fillable = [
        'seller_id',
        'name',
        'code',
        'birthday',
        'sex',
        'addressone',
        'addresssecond'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

}
