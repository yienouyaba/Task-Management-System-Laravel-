<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;


Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);
Route::get('/overdue-tasks', [DashboardController::class, 'overdue'])->name('overdue.tasks');
Route::get('/completed-tasks', [DashboardController::class, 'completed'])->name('completed.tasks');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::resource('tasks', TaskController::class);



