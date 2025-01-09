// web.php
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\TaskController;

// Route Utama
Route::get('/', function () {
    return view('welcome');
});

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Proyek (CRUD)
    Route::resource('projects', ProjectController::class);

    // Anggota Kelompok (CRUD)
    Route::prefix('projects/{project}')->group(function () {
        Route::get('/group-members/create', [GroupMemberController::class, 'create'])->name('group-members.create');
        Route::post('/group-members', [GroupMemberController::class, 'store'])->name('group-members.store');
    });

    Route::prefix('projects/{id}')->group(function () {
        Route::get('/add-member', [ProjectController::class, 'addMemberForm'])->name('projects.addMember');
        Route::post('/store-member', [ProjectController::class, 'storeMember'])->name('projects.storeMember');
    });

    Route::delete('/projects/{project}/members/{member}', [ProjectController::class, 'removeMember'])->name('projects.removeMember');

    // Tugas (CRUD)
    Route::prefix('projects/{project_id}')->group(function () {
        Route::get('/tasks/{user_id}', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/create/{user_id}', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    });

    Route::get('/projects/{id}/tasks', [TaskController::class, 'tasksByProject'])->name('tasks.byProject');

    // Profil (Edit, Update, Destroy)
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
