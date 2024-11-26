<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::select('id', 'title', 'description', 'category_id', 'author_id', 'status')
        ->with([
            'author:id,name', // Eager load author name
            'category:id,name' // Eager load category name
        ])
        ->paginate(10); // Add pagination
        
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = User::all(); // Only admin can assign authors
        return view('blogs.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'required|exists:users,id',
            'featured_image' => 'nullable|image|mimes:jpg,png,webp,gif|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_recommended' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('featured_images', 'public');
        }

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }
}

