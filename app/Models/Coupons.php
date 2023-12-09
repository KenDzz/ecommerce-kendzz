<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    public $table = "coupons";

    protected $fillable = [
        'id',
        'name',
        'describes',
        'type',
        'product_id',
        'is_use',
        'count',
        'is_exit',
        'created_at',
        'updated_at',
        'BeginDate',
        'Validate',
        'discount'
    ];

    public function UsersOrder(){
        return $this->hasMany(UsersOrder::class, 'coupons_id');
    }


    public function isExpired()
    {
        $beginDate = Carbon::parse($this->BeginDate);
        $endDate = $beginDate->copy()->addDays($this->Validate);
        $now = now();
        return $now->gte($beginDate) && $now->lt($endDate);
    }

    public function timeRemaining()
{
    $beginDate = Carbon::parse($this->BeginDate);
    $endDate = $beginDate->copy()->addDays($this->Validate);
    $now = now();

    if ($now->lt($beginDate)) {
        $remainingHours = $now->diffInHours($beginDate);
        return "Có thể sử dụng sau ".$this->formatRemainingTime($remainingHours, 'giờ');
    } elseif ($now->gte($beginDate) && $now->lt($endDate)) {
        $remainingHours = $now->diffInHours($endDate);
        return "Hết hạn sau ".$this->formatRemainingTime($remainingHours, 'giờ');
    } else {
        return -1;
    }
}

private function formatRemainingTime($time, $unit)
{
    if ($time < 24) {
        return $time . ' ' . $unit;
    } else {
        $remainingDays = floor($time / 24);
        return $remainingDays . ' ngày';
    }
}
}
