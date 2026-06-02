<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = [
            [
                'name'     => 'Nama Owner',
                'email'    => 'owner@eattrack.com',
                'password' => Hash::make('password123'),
                'role'     => 'owner',
                'phone'    => '08123456789',
            ],
            [
                'name'     => 'jijur',
                'email'    => 'customer@eattrack.com',
                'password' => Hash::make('password123'),
                'role'     => 'customer',
                'phone'    => '08987654321',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
