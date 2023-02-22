<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
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
        // User Create //
        User::factory(100)->create();
        // superAdmin's Role //
        User::factory(1)->superAdmin()->create();

        
        // Tag Create //
        Tag::create([
            'name' => 'Web',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Design',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Game',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Kuliner',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Air',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Meme',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Minuman',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Negara',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Wisata',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Bocil',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Wkwkwkwk',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Random',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Bunga',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Developer',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'Makanan',
            'created_by' => mt_rand(1,80)
        ]);
        Tag::create([
            'name' => 'GPS',
            'created_by' => mt_rand(1,80)
        ]);


        // Category Create //
        Category::create([
            'name' => 'Web Programming',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Web Design',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Game Developer',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Kuliner',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Anime',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Film',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Media',
            'created_by' => mt_rand(1,80)
        ]);
        Category::create([
            'name' => 'Personal',
            'created_by' => mt_rand(1,80)
        ]);







        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
