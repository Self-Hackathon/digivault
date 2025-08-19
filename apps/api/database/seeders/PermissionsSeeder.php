<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insertOrIgnore([
            ['name' => 'product.write'],
            ['name' => 'product.read'],
            ['name' => 'order.write'],
            ['name' => 'order.read'],
        ]);
    }
}
