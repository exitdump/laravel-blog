<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $myBlogs = Blog::with('category')->where('author_id', auth()->id())->latest()->paginate(10);
        return view('author.blogs.index', compact('myBlogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('author.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpg,png,webp,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
        ]);

        $validated['author_id'] = auth()->id();
        $category = Blog::create($validated);

        return $validated;
    }
}
