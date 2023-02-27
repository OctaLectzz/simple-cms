<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Web Programming',
        ]);
        Category::create([
            'name' => 'Web Design',
        ]);
        Category::create([
            'name' => 'Film',
        ]);
        Category::create([
            'name' => 'Anime',
        ]);
        Category::create([
            'name' => 'Personal',
        ]);
    }
}
