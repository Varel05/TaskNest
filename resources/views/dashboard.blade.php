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
        
            <!-- Projects Card -->
            <div class="container mx-auto">
                @if($projects->isEmpty())
                    <p class="text-center text-gray-600 dark:text-gray-300">You are not involved in any projects yet.</p>
                @else
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4">
                        @foreach ($projects as $project)
                            <div 
                                class="bg-white shadow rounded-lg hover:shadow-lg transition cursor-pointer" 
                                onclick="window.location='{{ route('projects.show', $project->id) }}'">
                                <!-- Project Name with Background -->
                                <div class="bg-blue-100 p-3 rounded-t-lg">
                                    <h5 class="text-lg font-semibold text-gray-700">{{ $project->name }}</h5>
                                </div>
                                <!-- Project Information -->
                                <div class="p-4">
                                    <table class="text-sm w-full">
                                        <tr>
                                            <td class="font-semibold text-gray-500">End Date</td>
                                            <td>: {{ $project->end_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-semibold text-gray-500">Team Leader</td>
                                            <td>: 
                                                @php
                                                    $leader = $project->groupMembers->firstWhere('role', 'leader');
                                                @endphp
                                                {{ $leader ? $leader->user->name : 'Unknown' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-semibold text-gray-500">Your Role</td>
                                            <td>: 
                                                @if ($project->created_by == auth()->id())
                                                    Leader
                                                @else
                                                    Member
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @endsection
        
    </div>
</x-app-layout>