<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'username' => 'refinaldy01',
                'email' => 'refinaldy@test.test',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'refinaldy02',
                'email' => 'refinaldy2@test.test',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        ])->each(fn ($user) => \App\Models\User::create($user));
    }
}
