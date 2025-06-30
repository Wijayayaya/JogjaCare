<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'dashboardadmin',
            'name' => 'Dashboard Admin',
            'email' => 'dashboardadmin@medical.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}