<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
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

        // $this->call(UserSeeder::class);


        // User Create //
        // My Profile //
        User::create([
            'images'            => 'Benedetta Profile.jpg',
            'name'              => 'Octavyan Putra Ramadhan',
            'email'             => 'octavyan4@gmail.com',
            'role'              => 'superAdmin',
            'jenis_kelamin'     => 'Laki-Laki',
            'tanggal_lahir'     => '2006-10-04',
            'alamat'            => 'Jl.Seta No.32 Larangan RT4/RW4 Gayam Sukoharjo',
            'password'          => bcrypt('Lectzz0410'),
            'email_verified_at' => now()
        ]);
        // User Random Create //
        User::factory(100)->create();
        // superAdmin's Role //
        User::factory(1)->superAdmin()->create();

        
        // Tag Create //
        Tag::create([
            'name' => 'Web',
        ]);
        Tag::create([
            'name' => 'Design',
        ]);
        Tag::create([
            'name' => 'Game',
        ]);
        Tag::create([
            'name' => 'Kuliner',
        ]);
        Tag::create([
            'name' => 'Air',
        ]);
        Tag::create([
            'name' => 'Meme',
        ]);
        Tag::create([
            'name' => 'Minuman',
        ]);
        Tag::create([
            'name' => 'Negara',
        ]);
        Tag::create([
            'name' => 'Wisata',
        ]);
        Tag::create([
            'name' => 'Bocil',
        ]);
        Tag::create([
            'name' => 'Wkwkwkwk',
        ]);
        Tag::create([
            'name' => 'Random',
        ]);
        Tag::create([
            'name' => 'Bunga',
        ]);
        Tag::create([
            'name' => 'Developer',
        ]);
        Tag::create([
            'name' => 'Makanan',
        ]);
        Tag::create([
            'name' => 'Push Up',
        ]);
        Tag::create([
            'name' => 'Workout',
        ]);
        Tag::create([
            'name' => 'Liburan',
        ]);
        Tag::create([
            'name' => 'Belajar',
        ]);
        Tag::create([
            'name' => 'Laravel',
        ]);
        Tag::create([
            'name' => 'Sekolah',
        ]);
        Tag::create([
            'name' => 'Magang',
        ]);


        // Category Create //
        Category::create([
            'name' => 'Web Programming',
        ]);
        Category::create([
            'name' => 'Web Design',
        ]);
        Category::create([
            'name' => 'Game Developer',
        ]);
        Category::create([
            'name' => 'Kuliner',
        ]);
        Category::create([
            'name' => 'Anime',
        ]);
        Category::create([
            'name' => 'Film',
        ]);
        Category::create([
            'name' => 'Olahraga',
        ]);
        Category::create([
            'name' => 'Media',
        ]);
        Category::create([
            'name' => 'Pendidikan',
        ]);
        Category::create([
            'name' => 'Hiburan',
        ]);
        Category::create([
            'name' => 'Personal',
        ]);


        // Post Create //
        // Post::factory(20)->create();







        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
