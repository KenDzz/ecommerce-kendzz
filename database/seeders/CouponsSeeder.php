<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            'id' => Str::random(10),
            'name' => "Freeship VIP",
            'describes' => "Mã giảm 100% tiền vận chuyển",
            'type' => 0,
            'product_id' => 0,
            'is_use' => false,
            'count' => 0,
            'is_exit' => false,
            'BeginDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'Validate' => 7,
            'discount' => 100,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
