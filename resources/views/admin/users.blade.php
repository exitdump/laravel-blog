<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div role="alert" class="alert alert-success mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Add New User Button -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-800">Users List</h2>
                        <a href="{{ route('admin.users.create') }}"
                            class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Add New User
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200 bg-white rounded-lg shadow">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="border border-gray-200 px-4 py-2 text-left text-sm font-medium text-gray-600">
                                        #</th>
                                    <th
                                        class="border border-gray-200 px-4 py-2 text-left text-sm font-medium text-gray-600">
                                        Name</th>
                                    <th
                                        class="border border-gray-200 px-4 py-2 text-left text-sm font-medium text-gray-600">
                                        Email</th>
                                    <th
                                        class="border border-gray-200 px-4 py-2 text-left text-sm font-medium text-gray-600">
                                        Role</th>
                                    <th
                                        class="border border-gray-200 px-4 py-2 text-left text-sm font-medium text-gray-600">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Repeat rows dynamically -->
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-200 px-4 py-2 text-sm text-gray-700">
                                            {{ $user->id }}</td>
                                        <td class="border border-gray-200 px-4 py-2 text-sm text-gray-700">
                                            {{ $user->name }}</td>
                                        <td class="border border-gray-200 px-4 py-2 text-sm text-gray-700">
                                            {{ $user->email }}</td>
                                        <td class="border border-gray-200 px-4 py-2 text-sm text-gray-700">
                                            {{ $user->role }}</td>
                                        <td class="border border-gray-200 px-4 py-2 text-sm text-gray-700">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="text-blue-500 hover:underline">Edit</a>
                                            <span class="mx-1">|</span>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Repeat rows dynamically -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
