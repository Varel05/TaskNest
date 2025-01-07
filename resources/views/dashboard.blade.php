<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Proyek Anda</h2>

    @if($projects->isEmpty())
        <p>Anda belum terlibat dalam proyek apa pun.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Deskripsi</th>
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
