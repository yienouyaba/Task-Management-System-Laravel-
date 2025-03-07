<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalProjects = Project::count();
    $totalTasks = Task::count();
    $overdueTasks = Task::where('due_date', '<', now())->where('status', '!=', 'completed')->count();
    $completedTasks = Task::where('status', 'completed')->count();

    return view('dashboard', compact('totalProjects', 'totalTasks', 'overdueTasks', 'completedTasks'));
}
public function overdue()
{
    $tasks = Task::where('due_date', '<', now())->where('status', '!=', 'completed')->get();
    return view('overdue_tasks', compact('tasks'));
}

public function completed()
{
    $tasks = Task::where('status', 'completed')->get();
    return view('completed_tasks', compact('tasks'));
}
}
