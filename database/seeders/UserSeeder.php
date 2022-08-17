<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '123',
            'address' => 'admin',
            'usertype' => User::USER_ADMIN,
            'password' => bcrypt('admin123'),
            'status' => 1,
        ]);
    }
}
