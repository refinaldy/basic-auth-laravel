<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();

        $profiles = array();
        foreach($users as $user){
            $profiles[] = [
                'user_id' => $user->id,
                'full_name' => $user->username,
                'description' => 'Deskripsi profile ' . $user->username,
            ];
        }

        \App\Models\UserProfile::insert($profiles);
    }
}
