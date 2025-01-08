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

    Route::delete('group-members/{member}', [GroupMemberController::class, 'kick'])->name('groupMember.kick');

    // Tugas (CRUD)
    // Route::prefix('tasks')->group(function () {
    //     Route::get('/', [TaskController::class, 'tasksByUser '])->name('tasks.byUser ');
    //     Route::get('/{project_id}/{user_id}', [TaskController::class, 'index'])->name('tasks.index');
    //     Route::get('/{userId}', [TaskController::class, 'show'])->name('tasks.show');
    //     Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    //     Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    // });

    Route::prefix('projects/{id}')->group(function () {
        Route::get('/tasks', [TaskController::class, 'tasksByProject'])->name('tasks.byProject');
    });

    Route::prefix('projects/{project_id}')->group(function () {
        Route::get('/tasks/create/{user_id}', [TaskController::class, 'createTask'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'storeTask'])->name('tasks.store');
    });

    // Profil (Edit, Update, Destroy)
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';