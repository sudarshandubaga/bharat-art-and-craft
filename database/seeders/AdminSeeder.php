<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'title' => 'Mr.',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('admin1234'),
                'phone' => '+91-9876543210',
            ]
        );
    }
}

