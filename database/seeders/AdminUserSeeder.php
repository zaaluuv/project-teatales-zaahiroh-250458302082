<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminteatales@gmail.com'], 
            [
                'name' => 'Admin',
                'username' => 'admin01',
                'password' => Hash::make('password'),
                'role' => 'admin', 
                'status' => 'active',
                'bio' => 'Akun Administrator Utama TeaTales.',
                'email_verified_at' => now(),
            ]
        );
    }
}