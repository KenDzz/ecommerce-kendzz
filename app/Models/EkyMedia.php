<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkyMedia extends Model
{
    use HasFactory;

    public $table = "ekyc_media";

    protected $fillable = [
        'seller_id',
        'url',
        'type'
    ];

    public $timestamps = false;

    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
