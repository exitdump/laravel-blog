<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogService
{
    /**
     * Get filtered blogs based on the provided filters
     *
     * @param  array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFilteredBlogs(Request $request, array $filters)
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

        return $query->paginate(10)->appends($request->query());;
    }

    public function getAllCategories()
    {
        return Category::select('id', 'name')->get();
    }

    public function getAllAuthors()
    {
        return User::select('id', 'name')->get();
    }

    // Get total counts for each status
    public function getTotalCounts()
    {
        // Get total counts for each status (published, draft, archived) in one query
        $statusCounts = Blog::selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status')
                            ->toArray();

        // Set default counts to 0 if not found
        $statusCounts = array_merge([
            'published' => 0,
            'draft' => 0,
            'archived' => 0,
            'total'=> $statusCounts['published'] + $statusCounts['draft'] + $statusCounts['archived'],
        ], $statusCounts);
        
        return $statusCounts;
    }
}
