<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }
    public function index(Request $request, BlogService $blogService)
    {
        $categories = $this->blogService->getAllCategories();
        $authors = $this->blogService->getAllAuthors();
        $totalBlog = $this->blogService->getTotalCounts();
        $blogs = $this->blogService->getFilteredBlogs($request, $request->query());

        return view('blogs.index', compact( 'categories', 'authors', 'totalBlog', 'blogs'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $authors = User::select('id', 'name')->where('role', 'author')->get();

        return view('blogs.create', compact('categories', 'authors'));
    }

    public function store(StoreBlogRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('featured_images', 'public');
        }

        Blog::create($validated);

        return to_route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::select('id', 'name')->get();
        $authors = User::select('id', 'name')->where('role', 'author')->get();

        return view('blogs.edit', compact('blog', 'categories', 'authors'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('featured_images', 'public');
        }

        $blog->update($validated);

        return to_route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return to_route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
