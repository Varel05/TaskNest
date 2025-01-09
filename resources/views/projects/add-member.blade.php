@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-50">
                Tambah Anggota Kelompok
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-200">
                Project: {{ $project->name }}
            </p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-gray-50 dark:bg-gray-800 shadow rounded-lg p-6">
            <!-- Project Leader Section -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                    Ketua Project
                </label>
                <div class="flex items-center border-2 bg-gray-50 dark:bg-gray-300 px-4 py-3 rounded-md">
                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>
                </div>
            </div>

            <!-- Add Members Form -->
            <form action="{{ route('group-members.store', $project->id) }}" method="POST">
                @csrf
                
                <div id="members-container" class="space-y-4">
                    <div class="member-item">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Anggota
                        </label>
                        <select name="members[0][user_id]" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-50 dark:bg-gray-300 border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                                required>
                            <option value="">Pilih Anggota</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="members[0][role]" value="member">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex items-center space-x-4">
                    <button type="button" 
                            id="add-member-btn"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-300 hover:dark:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="mr-2 -ml-1 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Anggota
                    </button>
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let memberIndex = 1;
    document.getElementById('add-member-btn').addEventListener('click', function() {
        const container = document.getElementById('members-container');
        const newMember = document.createElement('div');
        newMember.classList.add('member-item', 'relative');
        newMember.innerHTML = `
            <div class="flex items-center justify-between">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Anggota
                </label>
                <button type="button" onclick="this.closest('.member-item').remove()" 
                        class="text-gray-400 hover:text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <select name="members[${memberIndex}][user_id]" 
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                    required>
                <option value="">Pilih Anggota</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="members[${memberIndex}][role]" value="member">
        `;
        container.appendChild(newMember);
        memberIndex++;
    });
</script>
@endsection