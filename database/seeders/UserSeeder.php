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
        // Buat user admin (cek dulu apakah sudah ada)
        if (!User::where('email', 'admin@bukutamu.com')->exists()) {
            User::create([
                'name' => 'Admin Bukutamu',
                'email' => 'admin@bukutamu.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]);
        }

        // Buat user customer (cek dulu apakah sudah ada)
        if (!User::where('email', 'customer@bukutamu.com')->exists()) {
            User::create([
                'name' => 'Customer 1',
                'email' => 'customer@bukutamu.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]);
        }

        // Buat beberapa customer tambahan (cek dulu)
        $customers = [
            ['name' => 'Budi Santoso', 'email' => 'budi@email.com'],
            ['name' => 'Siti Rahayu', 'email' => 'siti@email.com'],
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad@email.com'],
        ];

        foreach ($customers as $customer) {
            if (!User::where('email', $customer['email'])->exists()) {
                User::create([
                    'name' => $customer['name'],
                    'email' => $customer['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'customer',
                ]);
            }
        }
    }
}