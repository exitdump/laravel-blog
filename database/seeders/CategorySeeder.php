<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Generate top-level categories
       Category::factory(10)->create()->each(function ($category) {
        $category->slug = Str::slug($category->name) . '-' . uniqid();
        $category->save();
    });;

       // Generate subcategories for each top-level category
       $parentCategories = Category::all();

       foreach ($parentCategories as $parent) {
           Category::factory(3)->create([
               'parent_category_id' => $parent->id,
           ]);
       }
    }
}
