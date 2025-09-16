<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin default
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );
    }
}
