<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logEkyc extends Model
{
    use HasFactory;


    public $table = "log_ekyc";

    protected $fillable = [
        'seller_id',
        'text',
    ];


    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
