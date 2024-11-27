<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

class BlogService
{
    /**
     * Get filtered blogs based on the provided filters
     *
     * @param  array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFilteredBlogs(array $filters)
    {
        $query = Blog::with(['author:id,name', 'category:id,name'])
                     ->select('id', 'title', 'description', 'category_id', 'author_id', 'status')
                     ->latest('created_at');

        // Apply filters dynamically
        if (isset($filters['status'])) {
            $query->statusFilter($filters['status']);
        }

        if (isset($filters['author'])) {
            $query->authorFilter($filters['author']);
        }

        if (isset($filters['category'])) {
            $query->categoryFilter($filters['category']);
        }

        return $query->paginate(10);
    }

    public function getAllCategories()
    {
        return Category::select('id', 'name')->get();
    }

    public function getAllAuthors()
    {
        return User::select('id', 'name')->get();
    }
}
