<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '012345678',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        // Create a regular user for testing
        User::create([
            'name' => 'NUM',
            'email' => 'num@gmail.com',
            'phone' => '087654321',
            'role' => 'user',
            'password' => Hash::make('12345678'),
        ]);
    }
}