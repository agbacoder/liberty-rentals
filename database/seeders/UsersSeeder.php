<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Admin1',
                'email'    => 'Admin1@example.com',
                'is_admin' => true,
            ],
            [
                'name'     => 'Alice Reader',
                'email'    => 'alice@example.com',
                'is_admin' => false,
            ],
            [
                'name'     => 'Bob Reader',
                'email'    => 'bob@example.com',
                'is_admin' => false,
            ],
            [
                'name'     => 'Charlie Reader',
                'email'    => 'charlie@example.com',
                'is_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name'     => $user['name'],
                    'password' => Hash::make('password'),
                    'is_admin' => $user['is_admin'],
                ]
            );
        }
    }
}
