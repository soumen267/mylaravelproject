<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 5,
                'name' => 'Product 1',
                'sku' => 'LIPS-001',
                'price' => 670.00,
                'originalprice' => 450.00,
                'image' => '202307080403product-image1-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 5,
                'name' => 'Product 2',
                'sku' => 'LIPS-002',
                'price' => 720.00,
                'originalprice' => 570.00,
                'image' => '202307080404product-image2-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 5,
                'name' => 'Product 3',
                'sku' => 'LIPS-003',
                'price' => 1200.00,
                'originalprice' => 900.00,
                'image' => '202307080404product-image3-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 6,
                'name' => 'Product 4',
                'sku' => 'JEW-001',
                'price' => 8090.00,
                'originalprice' => 9000.00,
                'image' => '202307080405jewellery-products1-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 6,
                'name' => 'Product 5',
                'sku' => 'JEW-002',
                'price' => 7000.00,
                'originalprice' => 7449.00,
                'image' => '202307080406jewellery-products2-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 6,
                'name' => 'Product 6',
                'sku' => 'JEW-003',
                'price' => 3000.00,
                'originalprice' => 3650.00,
                'image' => '202307080406jewellery-products3-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 1,
                'name' => 'Product 7',
                'sku' => 'BAG-001',
                'price' => 450.00,
                'originalprice' => 520.00,
                'image' => '202307080408bags-p-img1-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 1,
                'name' => 'Product 8',
                'sku' => 'BAG-002',
                'price' => 850.00,
                'originalprice' => 1020.00,
                'image' => '202307080410bags-p-img2-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 1,
                'name' => 'Product 9',
                'sku' => 'BAG-003',
                'price' => 750.00,
                'originalprice' => 2000.00,
                'image' => '202307080410bags-p-img3-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 2,
                'name' => 'Product 10',
                'sku' => 'WGARM-001',
                'price' => 2000.00,
                'originalprice' => 2400.00,
                'image' => '202307080414product-image5-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 2,
                'name' => 'Product 11',
                'sku' => 'WGARM-002',
                'price' => 5000.00,
                'originalprice' => 5350.00,
                'image' => '202307080415product-image6-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 2,
                'name' => 'Product 12',
                'sku' => 'WGARM-003',
                'price' => 4500.00,
                'originalprice' => 4890.00,
                'image' => '202307080415product-image7-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'category_id' => 2,
                'name' => 'Product 13',
                'sku' => 'WGARM-004',
                'price' => 6000.00,
                'originalprice' => 7350.00,
                'image' => '202307080416product-image8-1.jpg',
                'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.',
                'status' => '1',
                'feature' => '1',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
