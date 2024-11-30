<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                 
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.categories.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add New Category
                        </a>
                    </div>
                    
                   
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">#No</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Slug</th>
                                <th class="px-4 py-2 border">Parent Category</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $loop->index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $category->name }}</td>
                                    <td class="px-4 py-2 border">{{ $category->slug }}</td>
                                    <td class="px-4 py-2 border">{{ $category->parentCategory->name ?? 'None' }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-500">Edit</a>
                                        <span class="mx-1">|</span>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
