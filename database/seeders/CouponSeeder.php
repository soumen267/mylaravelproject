<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'name' => 'FREECODE',
                'description' => 'Global Discount for all products',
                'product' => NULL,
                'percentage' => 10.00,
                'discount' => 'Percent',
                'type' => 'Free',
                'maximum_value' => 3000,
                'maximum_usage' => 3,
                'is_active' => '1',
                'expires_at' => Carbon::now()->addDays(30),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'APPLYPRODUCT',
                'description' => 'This coupon apply for Product 1 and Product 2',
                'product' => NULL,
                'percentage' => 20.00,
                'discount' => 'Percent',
                'type' => 'Product',
                'maximum_value' => 4000,
                'maximum_usage' => 1,
                'is_active' => '1',
                'expires_at' => Carbon::now()->addDays(30),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'FREECODE1',
                'description' => 'This is a free coupon.',
                'product' => NULL,
                'percentage' => 20.00,
                'discount' => 'Doller',
                'type' => 'Free',
                'maximum_value' => 5000,
                'maximum_usage' => 6,
                'is_active' => '1',
                'expires_at' => Carbon::now()->addDays(30),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'APPLYPRODUCT1',
                'description' => 'This is a product specific coupon.',
                'product' => NULL,
                'percentage' => 15.00,
                'discount' => 'Doller',
                'type' => 'Product',
                'maximum_value' => 6000,
                'maximum_usage' => 4,
                'is_active' => '1',
                'expires_at' => Carbon::now()->addDays(30),
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
