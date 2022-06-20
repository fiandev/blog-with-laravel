<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
          'name' => "Aditia Akbar Putra Alfiansah",
          'username' => "Fian",
          'email' => "akbaraditia15@gmail.com",
          'email_verified_at' => now(),
          'password' => bcrypt("12345"),
        ]);
       
        User::factory(10)->create();
        Post::factory(100)->create();
        Category::create([
            "name" => "Programming",
            "slug" => "programming"
          ]);
        Category::create([
            "name" => "Personal",
            "slug" => "personal"
          ]);
        Category::create([
            "name" => "Web Design",
            "slug" => "web-design"
          ]);
        Category::create([
            "name" => "Game Development",
            "slug" => "game-development"
          ]);
        Category::factory(6)->create();
    }
}
