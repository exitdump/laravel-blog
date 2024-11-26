<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('author.blogs.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add New Blog
                        </a>
                    </div>


                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">#No</th>
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Description</th>
                                <th class="px-4 py-2 border">Category</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myBlogs as $blog)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $loop->index + 1 }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="#" class="hover:underline">
                                            <strong>
                                                {{ $blog->title }}
                                            </strong>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 border">{{ \Illuminate\Support\Str::limit($blog->description, 100) }}</td>
                                    <td class="px-4 py-2 border"> {{ $blog->category ? $blog->category->name : 'Uncategorized' }}</td>
                                    <td class="px-4 py-2 border">{{ $blog->status }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('author.blogs.edit', $blog) }}" class="text-blue-500">Edit</a>
                                        <span class="mx-1">|</span>
                                        <form action="{{ route('author.blogs.destroy', $blog) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $myBlogs->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
