<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

use function Pest\Laravel\json;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::select('id', 'title', 'description', 'category_id', 'author_id', 'status')
        ->with([
            'author:id,name', 
            'category:id,name' 
        ])
        ->latest('created_at')
        ->paginate(10); 
        
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        $authors = User::select('id', 'name')->where('role', 'author')->get();

        return view('blogs.create', compact('categories', 'authors'));
    }

    public function store(BlogRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('featured_images', 'public');
        }

        Blog::create($validated);
        
        return to_route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }
}

