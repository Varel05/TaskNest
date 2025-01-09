<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class);
    
    Route::resource('group-members', GroupMemberController::class)->only(['store']);
    Route::get('/group-members/create', [GroupMemberController::class, 'create'])->name('group-members.create');
    Route::get('projects/{project}/add-member', [GroupMemberController::class, 'addMemberForm'])->name('projects.addMemberForm');
    Route::post('projects/{project}/add-member', [GroupMemberController::class, 'storeMember'])->name('projects.storeMember');
    Route::delete('projects/{project}/remove-member/{user}', [GroupMemberController::class, 'removeMember'])->name('projects.removeMember');

    Route::resource('tasks', TaskController::class);
    Route::get('tasks/{task}/submit', [TaskController::class, 'submit'])->name('tasks.submit');
    Route::post('tasks/{task}/submit', [TaskController::class, 'storeSubmission'])->name('tasks.storeSubmission');

    Route::resource('comments', CommentController::class)->only(['store']);
    Route::get('tasks/{task}/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');

});

require __DIR__.'/auth.php';
