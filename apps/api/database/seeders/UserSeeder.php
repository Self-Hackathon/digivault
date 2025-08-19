<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@digivault.dev'],
            [
                'password'  => Hash::make('password'), // ganti nanti ke env()
                'is_active' => true,
            ]
        );

        $userId = DB::table('users')->where('email', 'admin@digivault.dev')->value('id');
        $roleId = DB::table('roles')->where('name', 'admin')->value('id');

        if ($userId && $roleId) {
            DB::table('user_roles')->updateOrInsert(
                ['user_id' => $userId, 'role_id' => $roleId],
                []
            );
        }
    }
}
