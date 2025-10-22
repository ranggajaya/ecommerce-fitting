<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat User Admin
        User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'role' => 'admin',
        ]);

        // Buat User Customer
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => bcrypt('password123'),
            'is_admin' => false,
            'role' => 'customer',
        ]);

        // Buat User Staff
        User::create([
            'name' => 'Staff Test',
            'email' => 'staff@test.com',
            'password' => bcrypt('password123'),
            'is_admin' => false,
            'role' => 'staff',
        ]);
    }
}