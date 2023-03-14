<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostSave;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(10)->create();
        $tags = Tag::factory()->count(50)->create();

        
        // Pinned Posts
        Post::factory()->count(8)->pinned()->create()->each(function ($post) use ($categories, $tags) {
            $post->category()->attach(
                $categories->random(rand(1, 5))->pluck('id')->toArray()
            );
            $post->tag()->attach(
                $tags->random(rand(10, 40))->pluck('id')->toArray()
            );
        });

        // More Posts
        Post::factory()->count(50)->create()->each(function ($post) use ($categories, $tags) {
            $post->category()->attach(
                $categories->random(rand(1, 5))->pluck('id')->toArray()
            );
            $post->tag()->attach(
                $tags->random(rand(10, 40))->pluck('id')->toArray()
            );
        });

        // Liked Posts
        Like::factory()
            ->count(5000)
            ->create();

        // Saved Posts
        PostSave::factory()
            ->count(500)
            ->create();
        }
}
