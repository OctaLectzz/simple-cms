<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // My Profile Create //
        User::create([
            'images'            => 'Benedetta Profile.jpg',
            'name'              => 'Octavyan Putra Ramadhan',
            'email'             => 'octavyan4@gmail.com',
            'role'              => 'superAdmin',
            'jenis_kelamin'     => 'Laki-Laki',
            'tanggal_lahir'     => '2006-10-04',
            'alamat'            => 'Jl.Seta No.32 Larangan RT4/RW4 Gayam Sukoharjo',
            'password'          => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        // User Random Create //
        User::factory(100)->create();

        // SuperAdmin Role Create //
        User::factory(1)->superAdmin()->create();
    }
}
