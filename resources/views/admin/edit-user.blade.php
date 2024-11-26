<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users / Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
                        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ $user->name }}" 
                                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    required>
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ $user->email }}" 
                                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    required>
                            </div>
                            
                            <!-- Role -->
                            <div class="mb-4">
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select 
                                    id="role" 
                                    name="role" 
                                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    required>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="author" {{ $user->role === 'author' ? 'selected' : '' }}>Author</option>
                                </select>
                            </div>
                            
                            <!-- Avatar -->
                            <div class="mb-4">
                                <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
                                <input 
                                    type="file" 
                                    id="avatar" 
                                    name="avatar" 
                                    accept="image/*" 
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-gray-300 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                
                                @if ($user->avatar)
                                    <p class="mt-2 text-sm text-gray-500">Current Avatar:</p>
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar" class="mt-2 h-16 w-16 rounded-full">
                                @endif
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                                    Update User
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
