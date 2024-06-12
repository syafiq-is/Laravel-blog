<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Han Sooyoung',
            'email' => 'han.sy@email.com',
            'password' => Hash::make('123'),
            'profile_img' => 'profile/profile_default.png',
            'isAdmin' => true
        ]);
        User::create([
            'username' => 'Kim Dokja',
            'email' => 'kim.dj@email.com',
            'password' => Hash::make('123'),
            'profile_img' => 'profile/profile_kdj.jpg',
            'isAdmin' => true
        ]);
        User::create([
            'username' => 'Yoo Joonghyuk',
            'email' => 'yoo.jh@email.com',
            'password' => Hash::make('123'),
            'profile_img' => 'profile/profile_yjh.jpg'
        ]);

        Category::create([
            'category' => 'Psychology',
        ]);
        Category::create([
            'category' => 'Gaming',
        ]);

        Post::factory(15)->create();
    }
}
