<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Total Users Widget -->
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Total Users</h3>
                                <p class="text-2xl font-semibold text-gray-800">{{$total['users']}}</p>
                            </div>
                            <div class="flex items-center justify-center h-12 w-12 bg-blue-100 rounded-full">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m7 5v-2a4 4 0 00-3-3.87m4-7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Total Blogs Widget -->
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Total Blogs</h3>
                                <p class="text-2xl font-semibold text-gray-800">{{$total['blogs']}}</p>
                            </div>
                            <div class="flex items-center justify-center h-12 w-12 bg-green-100 rounded-full">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a7 7 0 01-14 0m14 0a7 7 0 00-14 0" />
                                </svg>
                            </div>
                        </div>

                        <!-- Total Categories Widget -->
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow">
                            <div>
                                <h3 class="text-sm font-medium text-gray-600">Total Categories</h3>
                                <p class="text-2xl font-semibold text-gray-800">{{$total['categories']}}</p>
                            </div>
                            <div class="flex items-center justify-center h-12 w-12 bg-yellow-100 rounded-full">
                                <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h11M9 21V3m0 18a9 9 0 00-9-9h0a9 9 0 009 9zm0-18a9 9 0 019 9h0a9 9 0 01-9-9z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Blog Section -->
            <div class="bg-white shadow sm:rounded-lg p-6 mb-5">
                <h3 class="text-lg font-semibold mb-4 text-indigo-600">Featured Blog</h3>
                @if ($featuredBlog)
                    <div class="border p-4 rounded-lg">
                        <h4 class="text-xl font-bold">{{ $featuredBlog->title }}</h4>
                        <p class="text-sm text-gray-500 mb-2">
                            By {{ $featuredBlog->author->name }} | Published:
                            {{ $featuredBlog->created_at->format('M d, Y') }}
                        </p>
                        <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($featuredBlog->description, 150) }}
                        </p>
                        <a href="{{ route('single', [$featuredBlog->category, $featuredBlog]) }}" class="text-blue-500 hover:underline mt-2 inline-block">Read More</a>
                    </div>
                @else
                    <p class="text-gray-500">No featured blog available.</p>
                @endif
            </div>

            <!-- Recommended Blogs Section -->
            <div class="bg-white shadow sm:rounded-lg p-6 mb-5">
                <h3 class="text-lg font-semibold mb-4 text-indigo-600">Recommended Blogs</h3>
                @if ($recommendedBlogs->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($recommendedBlogs as $blog)
                            <div class="border p-4 rounded-lg">
                                <h4 class="font-bold">{{ $blog->title }}</h4>
                                <p class="text-sm text-gray-500 mb-2">
                                    By {{ $blog->author->name }} | Published: {{ $blog->created_at->format('M d, Y') }}
                                </p>
                                <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($blog->description, 100) }}
                                </p>
                                <a href="{{ route('single', [$blog->category->slug ?? 'uncategorized', $blog]) }}" class="text-blue-500 hover:underline mt-2 inline-block">Read More</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No recommended blogs available.</p>
                @endif
            </div>

            <!-- Latest Posts Section -->
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-indigo-600">Latest Blogs</h3>
                <ul>
                    @forelse($latestBlogs as $blog)
                        <li class="mb-4">
                            <a href="{{ route('single', [$blog->category->slug ?? 'uncategorized', $blog]) }}"
                                class="font-semibold text-gray-900 hover:underline">{{ $blog->title }}</a>
                            <p class="text-sm text-gray-500">Published on: {{ $blog->created_at->format('M d, Y') }}
                            </p>
                        </li>
                    @empty
                        <p class="text-gray-500">No blogs found.</p>
                    @endforelse
                </ul>
            </div>


        </div>
    </div>
</x-app-layout>
