<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'Product 1',
                'description' => 'Description for product 1',
                'price' => 10,
                'price_currency' => 'USD',
                'has_license' => false,
            ]
        );
    }
}
