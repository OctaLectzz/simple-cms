<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
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
            'is_pinned' => 0,
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'content' => collect($this->faker->paragraphs(mt_rand(5,10)))
                        ->map(fn($p) => "<p>$p</p>")
                        ->implode(''),
            'created_by' =>$this->faker->name(),
        ];
    }


    public function Pinned()
    {
        return $this->state(fn (array $attributes) => [
            'is_pinned' => 1,
        ]);
    }
}
