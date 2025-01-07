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

        @extends('layouts.app')

        @section('content')
        <div class="container">
            <h2>Proyek Anda</h2>

            <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
        
            @if($projects->isEmpty())
                <p>Anda belum terlibat dalam proyek apa pun.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Proyek</th>
                            <th>Nama Ketua</th>
                            <th>Status</th>
                            <th>Periode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ ucfirst($project->status) }}</td>
                            <td>{{ $project->start_date }} - {{ $project->end_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        @endsection   
        
</x-app-layout>