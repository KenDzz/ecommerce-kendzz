<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    use HasFactory;

    public $table = "users_verify";


    protected $fillable = [
        'user_id',
        'token',
        'otp',
        'is_otp_verified'
    ];


    protected $casts = [
        'otp_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
