<?php

namespace App\Services;

use App\Models\Blog;

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

        if (isset($filters['by'])) {
            $query->authorFilter($filters['by']);
        }

        if (isset($filters['category'])) {
            $query->categoryFilter($filters['category']);
        }

        return $query->paginate(10);
    }
}
