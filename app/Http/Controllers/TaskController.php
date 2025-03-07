<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
{
    $query = Task::with('project');

    // Filtrage par statut
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    // Filtrage par priorité
    if ($request->has('priority') && !empty($request->priority)) {
        $query->where('priority', $request->priority);
    }

    $tasks = $query->get();

    $statuses = ['pending', 'in_progress', 'completed'];
    $priorities = ['low', 'medium', 'high'];

    return view('tasks.index', compact('tasks', 'statuses', 'priorities'));
}

    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|string|in:pending,in_progress,completed',
        'priority' => 'required|string|in:low,medium,high',
        'project_id' => 'required|exists:projects,id',
        'due_date' => 'nullable|date',
    ]);

    Task::create($request->except('_token'));

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
}
    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

        public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
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


    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
