<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => "Iphone 14 Pro Max",
                'price' => 1200.00,
                'qty' => 10,
                'description' => "Latest iPhone",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Samsung Galaxy S23 Ultra",
                'price' => 1100.00,
                'qty' => 15,
                'description' => "Flagship Samsung",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Google Pixel 7 Pro",
                'price' => 900.00,
                'qty' => 20,
                'description' => "Best Android Camera",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('products_tb')->insert($products);
    }
}

