<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

//        Category::factory(15)->create();
        Room::factory(10)->create();
//        Tag::factory(15)->create();
        Feature::factory(10)->create();
//
//        Post::all()->each(function ($post){
//            $post->tags()->attach(Tag::inRandomOrder()->limit(rand(1,4))->get()->pluck('id'));
//        });

//        User::create([
//            'name' => "Hein Ko Ko",
//            'email' => "hkk@gmail.com",
//            'email_verified_at' => now(),
//            'password' => Hash::make('00000000'), // password
//            'remember_token' => Str::random(10),
//            "role" => '0'
//        ]);

    }

}
