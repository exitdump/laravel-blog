<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'category_id' => Category::inRandomOrder()->first()->id ?? null,
            'author_id' => User::inRandomOrder()->first()->id,
            'featured_image' => null, // Add image upload logic if needed
            'image_caption' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'is_featured' => $this->faker->boolean,
            'is_recommended' => $this->faker->boolean,
        ];
    }
}

