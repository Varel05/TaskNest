<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <div class="py-4 px-6">
        <!-- Header Section -->
        <div class="bg-green-50 p-4 rounded-lg shadow-sm mb-6 h-20"> <!-- Tambah h-16 untuk mengunci tinggi -->
            <div class="flex justify-between items-center h-full"> <!-- Tambah h-full -->
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="TaskNest" class="h-full w-auto py-1" style="max-height: 110px;"> <!-- Sesuaikan max-height -->
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($projects as $project)
                <a href="{{ route('projects.show', $project->id) }}" 
                   class="block bg-green-100 p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $project->name }}</h2>
                    <p class="text-gray-600">
                        Ketua Kelompok: <span class="font-medium">{{ $project->leader_name }}</span>
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>