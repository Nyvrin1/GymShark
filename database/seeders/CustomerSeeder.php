<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Admin Customer
        Customer::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone' => '1234567890',
            'address' => 'Admin Address',
            'password' => Hash::make('admin123'),
            'isAdmin' => 1,
        ]);

        // Regular Customers
        Customer::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'address' => '1234 Elm Street',
            'password' => Hash::make('password123'),
            'isAdmin' => 0,
        ]);

        Customer::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'phone' => '0987654321',
            'address' => '4321 Maple Avenue',
            'password' => Hash::make('password123'),
            'isAdmin' => 0,
        ]);
    }
}
