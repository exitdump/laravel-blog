<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are some categories and users
        if (Category::count() === 0) {
            Category::factory(5)->create(); // Assuming a factory exists
        }

        if (User::count() === 0) {
            User::factory(3)->create(); // Assuming a factory exists
        }

        // Generate blogs
        Blog::factory(20)->create(); // Generates 20 blogs
    }
}
