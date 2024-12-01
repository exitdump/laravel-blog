<x-app-layout>

    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Featured Image -->
        <div class="relative rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('storage/' . $blog->featured_image) ?? asset('storage/' . 'images/no_thumbnail.png') }}" 
                 alt="{{ $blog->title }}" 
                 class="w-full h-96 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-80"></div>
            <div class="absolute bottom-5 left-5 text-white">
                <h1 class="text-4xl font-bold">{{ $blog->title }}</h1>
                <p class="mt-2 text-lg">{{ $blog->category->name ?? 'Uncategorized' }}</p>
            </div>
        </div>

        <!-- Blog Content -->
        <div class="max-w-3xl mx-auto mt-10">
            <div class="flex items-center gap-4 mb-6">
                <div class="flex-shrink-0">
                    <img src="{{ $blog->author->avatar ?? asset('storage/' .'images/default-avatar.png') }}" 
                         alt="{{ $blog->author->name }}" 
                         class="h-12 w-12 rounded-full object-cover">
                </div>
                <div>
                    <p class="text-lg font-semibold">{{ $blog->author->name }}</p>
                    <p class="text-sm text-gray-500">{{'Published on : ' . $blog->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Blog Description -->
            <div class="prose max-w-none">
                {!! $blog->description !!}
            </div>

            <!-- Tags/Labels -->
            @if($blog->is_featured || $blog->is_recommended)
                <div class="mt-6 flex gap-2">
                    @if($blog->is_featured)
                        <span class="px-3 py-1 text-sm font-medium text-white bg-green-500 rounded-full">Featured</span>
                    @endif
                    @if($blog->is_recommended)
                        <span class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-full">Recommended</span>
                    @endif
                </div>
            @endif
        </div>

        <!-- Back to Blogs -->
        <div class="text-center mt-10">
            <a href="{{ route('dashboard') }}" 
               class="inline-block px-6 py-3 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-500">
                Back to Dashboard
            </a>
        </div>
    </div>

</x-app-layout>