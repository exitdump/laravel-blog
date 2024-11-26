<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get all the blogs from the database
        // with the author and category information
        // and show them in the index view
        $blogs = Blog::select('id', 'title', 'description', 'category_id', 'author_id', 'status')
            ->with([
                'author:id,name',
                'category:id,name'
            ])
            ->latest('created_at')
            ->paginate(10);

        // Return the view with the blogs
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Get all the categories and authors from the database
        // to be used in the create view
        $categories = Category::select('id', 'name')->get();
        $authors = User::select('id', 'name')->where('role', 'author')->get();

        // Return the create view with the categories and authors
        return view('blogs.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created blog in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreBlogRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // If the request has a featured image,
        // store it in the public/featured_images directory
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('featured_images', 'public');
        }

        // Create the blog using the validated data
        Blog::create($validated);

        // Redirect to the index page with a success message
        return to_route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Blog $blog)
    {
        // Get all the categories and authors from the database
        // to be used in the edit view
        $categories = Category::select('id', 'name')->get();
        $authors = User::select('id', 'name')->where('role', 'author')->get();

        // Return the edit view with the blog, categories and authors
        return view('blogs.edit', compact('blog', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        // Validate the request
        $validated = $request->validated();

        // If the request has a featured image,
        // store it in the public/featured_images directory
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('featured_images', 'public');
        }

        // Update the blog using the validated data
        $blog->update($validated);

        // Redirect to the index page with a success message
        return to_route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $blog)
    {
        // Delete the blog
        $blog->delete();

        // Redirect to the index page with a success message
        return to_route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
