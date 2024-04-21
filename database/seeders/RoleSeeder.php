<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id_role' => 1, 'role_name' => 'Super Admin'],
            ['id_role' => 2, 'role_name' => 'Admin'],
            ['id_role' => 3, 'role_name' => 'User'],
        ];

        DB::table('roles')->insert($roles);
    }
}
