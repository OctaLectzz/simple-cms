<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'title' => $this->faker->sentence(mt_rand(2,8)),
                'slug' => $this->faker->slug(),
                'content' => collect($this->faker->paragraphs(mt_rand(5,10)))
                            ->map(fn($p) => "<p>$p</p>")
                            ->implode(''),
                'tag_id' => mt_rand(1,10),
                'category_id' => mt_rand(1,7),
                'postImages' => 'image 1.png'
        ];
    }
}
