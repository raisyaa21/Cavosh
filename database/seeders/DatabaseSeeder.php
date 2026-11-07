<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name'     => 'Admin Cavosh',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        // 2. Akun Customer Biasa
        User::create([
            'name'     => 'User Biasa',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'user',
        ]);

        // 3. Panggil Seeder Menu
        $this->call([
            MenuSeeder::class,
        ]);
    }
}
