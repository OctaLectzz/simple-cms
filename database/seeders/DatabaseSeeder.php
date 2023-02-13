<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
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

        User::create([
            'images' => 'Benedetta Profile.jpg',
            'name' => 'Octavyan Putra Ramadhan',
            'email' => 'octavyan4@gmail.com',
            'role' => 'superAdmin',
            'jenis_kelamin' => 'Laki-Laki',
            'tanggal_lahir' => '2006-10-04',
            'alamat' => 'Jl.Seta No.32 Larangan RT4/RW4 Gayam Sukoharjo',
            'password' => bcrypt('Lectzz0410'),
            'email_verified_at' => now()
        ]);

        User::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
