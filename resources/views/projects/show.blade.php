@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Project Details Card -->
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
        <!-- Header Section -->
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                Detail Project: <span>{{ $project->name }}</span>
            </h1>
        </div>

        <!-- Project Information Card -->
        <div class="p-6 bg-gray-50 dark:bg-gray-800 space-y-6">
            <!-- Description -->
            <div class="grid md:grid-cols-1 gap-6">
                <div class="flex items-center space-x-3 bg-white dark:bg-gray-300 p-4 rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <div>
                        <span class="block text-sm text-gray-600 dark:text-gray-700">Deskripsi</span>
                        <span class="font-medium text-gray-800">{{ $project->description }}</span>
                    </div>
                </div>
            </div>

            <!-- Dates Section -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-center space-x-3 bg-white dark:bg-gray-300 p-4 rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-green-500 dark:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <span class="block text-sm text-gray-600 dark:text-gray-700">Tanggal Mulai</span>
                        <span class="font-medium text-gray-800">{{ $project->start_date }}</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 bg-white dark:bg-gray-300 p-4 rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-red-500 dark:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <span class="block text-sm text-gray-600 dark:text-gray-700">Tanggal Berakhir</span>
                        <span class="font-medium text-gray-800">{{ $project->end_date }}</span>
                    </div>
                </div>
            </div>

            <!-- Status & Created By -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-center space-x-3 bg-white dark:bg-gray-300 p-4 rounded-lg shadow-sm">
                    <span class="block text-sm text-gray-600 dark:text-gray-700">Status :</span>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                        @if($project->status == 'active')
                            bg-green-100 text-green-800
                        @elseif($project->status == 'pending')
                            bg-yellow-100 text-yellow-800
                        @else
                            bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>
                
                <div class="flex items-center space-x-3 bg-white dark:bg-gray-300 p-4 rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <div>
                        <span class="block text-sm text-gray-600 dark:text-gray-700">Dibuat Oleh</span>
                        <span class="font-medium text-gray-800">{{ $project->created_by }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Members Section -->
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Anggota Kelompok</h3>
            <!-- Add Member Button -->
            <a href="{{ route('projects.addMember', $project->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="mr-2 -ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Anggota
            </a>
        </div>
        
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-200 divide-y divide-gray-200">
                        @foreach ($project->groupMembers as $member)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $member->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($member->role == 'leader')
                                            bg-blue-100 text-blue-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($member->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($member->role == 'leader')
                                        <a href="{{ route('tasks.index', ['project_id' => $project->id, 'user_id' => $member->user_id]) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Task
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="max-w-4xl mx-auto mt-6">
        <a href="{{ route('dashboard') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white dark:text-gray-100 dark:bg-gray-800 hover:dark:bg-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2">
            <svg class="mr-2 -ml-1 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>
</div>
@endsection