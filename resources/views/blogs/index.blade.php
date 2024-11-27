<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Manage Blogs') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success shadow-lg mb-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Add New Blog Button -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-700">All Blogs</h3>
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                    Add New Blog
                </a>
            </div>

            <!-- Table Container -->
            <div class="bg-white shadow-md rounded-lg overflow-x-auto p-8">
                <!-- Status Links Section -->
                <div class="mb-6">
                    <ul class="flex space-x-4 text-gray-700 font-xs">
                        <li>
                            <a href="{{ route('admin.blogs.index', ['status' => 'published']) }}"
                                class="hover:underline {{ request('status') === 'published' ? 'text-indigo-600 font-semibold' : '' }}">
                                Published ({{ '63' }})
                            </a>
                        </li>
                        <span>|</span>
                        <li>
                            <a href="{{ route('admin.blogs.index', ['status' => 'draft']) }}"
                                class="hover:underline {{ request('status') === 'draft' ? 'text-indigo-600 font-semibold' : '' }}">
                                Draft ({{ '20' }})
                            </a>
                        </li>
                        <span>|</span>
                        <li>
                            <a href="{{ route('admin.blogs.index', ['status' => 'archived']) }}"
                                class="hover:underline {{ request('status') === 'archived' ? 'text-indigo-600 font-semibold' : '' }}">
                                Archived ({{ '25' }})
                            </a>
                        </li>
                        <span>|</span>
                        <li>
                            <a href="{{ route('admin.blogs.index') }}"
                                class="hover:underline {{ !request('status') ? 'text-indigo-600 font-semibold' : '' }}">
                                All ({{ '59' }})
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center justify-between mb-4">
                 <!-- Bulk Action Section -->
            <form method="POST" action="{{ route('admin.blogs.index') }}">
                @csrf
                <div class="mb-4 flex items-center space-x-4">
                    <select name="action" class="select select-bordered w-40" required>
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete</option>
                        <option value="publish">Publish</option>
                        <option value="draft">Move to Draft</option>
                        <option value="archive">Archive</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </form>

            <!-- Filter Section -->
            <form method="GET" action="{{ route('admin.blogs.index') }}" class="mb-4 flex space-x-4">
                <select name="category" class="select select-bordered w-40" onchange="this.form.submit()">
                    <option value="">Filter by Category</option>
                    {{-- @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach --}}
                </select>

                <select name="author" class="select select-bordered w-40" onchange="this.form.submit()">
                    <option value="">Filter by Author</option>
                    {{-- @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach --}}
                </select>

                <select name="status" class="select select-bordered w-40" onchange="this.form.submit()">
                    <option value="">Filter by Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>

                <button type="submit" class="btn btn-primary">Apply</button>
            </form>
                </div>
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">
                                <input type="checkbox" id="selectAll" class="cursor-pointer">
                            </th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Title</th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Category</th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Author</th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Status</th>
                            <th class="px-4 py-2 text-center border border-gray-300 text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border border-gray-300">
                                    <input type="checkbox" class="cursor-pointer">
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                        class="text-blue-500 hover:underline font-medium">
                                        {{ $blog->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $blog->category ? $blog->category->name : 'Uncategorized' }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">{{ $blog->author->name }}</td>
                                <td class="px-4 py-2 border border-gray-300">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs
                                        {{ $blog->status === 'published' ? 'text-green-600' : ($blog->status === 'draft' ? 'text-gray-500' : 'text-red-600') }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.blogs.edit', $blog) }}"
                                            class="text-blue-500 font-semibold">Edit</a>
                                        <span class="mx-1">|</span>
                                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 font-semibold">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                    No blogs found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">
                                <input type="checkbox" id="selectAll" class="cursor-pointer">
                            </th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Title</th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Category</th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Author</th>
                            <th class="px-4 py-2 text-left border border-gray-300 text-gray-600">Status</th>
                            <th class="px-4 py-2 text-center border border-gray-300 text-gray-600">Actions</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- Pagination -->
            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
            </div>      
        </div>
    </div>
</x-app-layout>
