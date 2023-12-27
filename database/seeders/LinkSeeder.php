<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();

        $links = array();
        foreach($users as $user){
            $links[] = [
                'user_id' => $user->id,
                'url' => 'https://www.facebook.com/',
            ];
            $links[] = [
                'user_id' => $user->id,
                'url' => 'https://www.youtube.com/',
            ];
            $links[] = [
                'user_id' => $user->id,
                'url' => 'https://www.instagram.com/',
            ];
        }
        
        \App\Models\Link::insert($links);
    }
}
