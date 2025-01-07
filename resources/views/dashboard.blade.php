<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <div class="py-4 px-6">
        <!-- Header Section -->
        <div class="bg-green-100 p-4 rounded-lg shadow-sm mb-6 h-18"> <!-- Tambah h-16 untuk mengunci tinggi -->
            <div class="flex justify-between items-center h-full"> <!-- Tambah h-full -->
                <div class="flex items-center">
                    <span class="text-xl text-align-center font-semibold ml-2">List Project</span>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('projects.create') }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                        Tambah Project
                    </a>
                    @auth
                        <!-- Jika sudah login, tampilkan nama user atau menu -->
                    @else
                        <a href="{{ route('login') }}" 
                           class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-white text-green-600 px-4 py-2 rounded-md border border-green-600 hover:bg-green-50 transition">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        @section('content')
        <div class="container mx-auto p-6">
            <!-- Title and Add Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Projects</h1>
                <a href="{{ route('projects.create') }}" 
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Add Project
                </a>
            </div>

            <!-- Projects Table -->
            <div class="overflow-x-auto ">
                <table class="min-w-full bg-white dark:bg-gray-900 shadow-md overflow-hidden">
                    <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-gray-700 dark:text-white">{{ $project->name }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-white">{{ $project->status }}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <!-- View Button -->
                                    <a href="{{ route('projects.show', $project->id) }}" 
                                        class="text-blue-600 hover:text-blue-800">
                                        View
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('projects.edit', $project->id) }}" 
                                        class="text-yellow-600 hover:text-yellow-800">
                                        Edit
                                    </a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('projects.destroy', $project->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="text-red-600 hover:text-red-800">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endsection
    </div>
</x-app-layout>