<x-app-layout>
    @push('head')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    @endpush
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Main Section (Left) -->
                <div class="col-span-2 bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Create New Blog</h2>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Blog Create Form -->
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-4">
                            <div id="editor"></div>
                            <input type="hidden" name="description" id="description" value="{{ old('description') }}" />
                        </div>


                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-full">Save Blog</button>
                        </div>

                </div>

                <!-- Sidebar (Right) -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Blog Settings</h3>

                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Select Status</option>

                            <option value="{{ __('published') }}" {{ old('status') == 'published' ? 'selected' : '' }}>
                                {{ __('published') }}
                            </option>
                            <option value="{{ __('published') }}" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                {{ __('draft') }}
                            </option>
                        </select>
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Featured Image -->
                    <div class="mb-4">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured
                            Image</label>
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <small class="text-gray-500">Supported formats: JPG, PNG, WEBP, GIF</small>
                    </div>

                    <!-- Assign Author (Only for Admins) -->
                    {{-- @can('assign-author') --}}
                    <div class="mb-4">
                        <label for="author_id" class="block text-sm font-medium text-gray-700">Assign Author</label>
                        <select name="author_id" id="author_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- @endcan --}}
                </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            const quill = new Quill('#editor', {
                theme: 'snow', // 'bubble' theme is also available
                placeholder: 'Write your blog description here...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'], // Formatting buttons
                        ['blockquote', 'code-block'], // Blocks
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }], // Lists
                        [{
                            'header': [1, 2, 3, false]
                        }], // Headers
                        [{
                            'color': []
                        }, {
                            'background': []
                        }], // Colors
                        ['link', 'image', ], // Media
                        ['clean'], // Remove formatting
                    ]
                }
            });

            quill.root.innerHTML = document.getElementById('description').value;

            quill.on('text-change', function (delta, oldDelta, source) {
                document.getElementById('description').value = quill.root.innerHTML;
            });
        </script>
    @endpush
</x-app-layout>
