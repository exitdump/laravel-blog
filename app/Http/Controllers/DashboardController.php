<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // Fetch total counts for Users, Blogs, and Categories
        $totalUsers = User::count();
        $totalBlogs = Blog::count();
        $totalCategories = Category::count();
        
        $total = [
            'users' => $totalUsers,
            'blogs' => $totalBlogs,
            'categories' => $totalCategories
        ];

        $featuredBlog = Blog::where('is_featured', true)
            ->with('author') // Eager load the author relationship
            ->first();

        $recommendedBlogs = Blog::where('is_recommended', true)
            ->with('author') // Eager load the author relationship
            ->take(6)
            ->get();

        $latestBlogs = Blog::orderBy('created_at', 'desc')
            ->with('author') // Eager load the author relationship
            ->take(5)
            ->get();


        return view('dashboard', compact('latestBlogs', 'featuredBlog', 'recommendedBlogs', 'total'));
    }

    public function single(Category $category, Blog $blog)
    {
        // Check if the blog belongs to the category
        if ($blog->category_id !== $category->id) {
            abort(404); // Return a 404 error if it doesn't match
        }

        return view('single', compact('blog', 'category'));
    }
}
