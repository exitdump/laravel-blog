<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->word;
        return [
            'name' => ucfirst($title), // Generates a random word as the category name
            'slug' => Str::slug($title), // Converts the title to a slug
            'parent_category_id' => null, // By default, no parent category
            'description' => $this->faker->sentence, // Generates a random sentence
        ];
    }
}
