<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
