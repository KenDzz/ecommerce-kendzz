<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersChat extends Model
{
    use HasFactory;

    public $table = "users_chat";

    protected $fillable = [
        'senderID',
        'receiverID',
        'message',
        'product_id'
    ];

}
