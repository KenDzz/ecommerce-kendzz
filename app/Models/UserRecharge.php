<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecharge extends Model
{
    use HasFactory;

    public $table = "users_recharge";

    protected $fillable = [
        'user_id',
        'trans_id',
        'amount',
        'bank_code',
        'code',
        'message',
        'message_callback'
    ];


}
