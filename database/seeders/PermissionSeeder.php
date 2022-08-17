<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'permission read', 'status' => 1],
            ['name' => 'permission create', 'status' => 1],
            ['name' => 'permission edit', 'status' => 1],
            ['name' => 'permission delete', 'status' => 1],
            ['name' => 'role read', 'status' => 1],
            ['name' => 'role create', 'status' => 1],
            ['name' => 'role edit', 'status' => 1],
            ['name' => 'role delete', 'status' => 1],
            ['name' => 'user read', 'status' => 1],
            ['name' => 'user create', 'status' => 1],
            ['name' => 'user edit', 'status' => 1],
            ['name' => 'user delete', 'status' => 1],
        ]);
    }
}
