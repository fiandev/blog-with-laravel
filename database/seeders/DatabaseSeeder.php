<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Role;
use App\Models\Role_user;
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
        Role_user::create([
            "user_id" => 1,
            "role_id" => 1
          ]);
        Role_user::create([
            "user_id" => 1,
            "role_id" => 2
          ]);
        Role_user::create([
            "user_id" => 1,
            "role_id" => 3
          ]);
        Role_user::create([
            "user_id" => 2,
            "role_id" => 1
          ]);
        Role_user::create([
            "user_id" => 2,
            "role_id" => 2
          ]);
        Role_user::create([
            "user_id" => 2,
            "role_id" => 3
          ]);
        User::create([
          'name' => "Aditia Akbar Putra Alfiansa",
          'username' => "Fian",
          'slug' => "Fian",
          'email' => "akbaraditia15@gmail.com",
          'email_verified_at' => now(),
          'password' => bcrypt("12345")
        ]);
        User::create([
          'name' => "Roronoa Zoro",
          'username' => "Zoro",
          'slug' => "zoro",
          'email' => "zoro@mugiwara.com",
          'email_verified_at' => now(),
          'password' => bcrypt("12345")
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
        Role::create([
            "name" => "administrator"
            ]);
        Role::create([
            "name" => "moderator"
          ]);
        Role::create([
            "name" => "member"
          ]);
        Category::factory(6)->create();
    }
}
