@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Edit Task</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Task Title -->
                        <div class="mb-3">
                            <label for="title" class="fw-bold">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
                        </div>

                        <!-- Task Description -->
                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description:</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="fw-bold">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <!-- Priority -->
                        <div class="mb-3">
                            <label for="priority" class="fw-bold">Priority:</label>
                            <select name="priority" id="priority" class="form-select">
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-3">
                            <label for="due_date" class="fw-bold">Due Date:</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}" required>
                        </div>

                        <!-- Project Selection -->
                        <div class="mb-3">
                            <label for="project_id" class="fw-bold">Project:</label>
                            <select name="project_id" id="project_id" class="form-select">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Update Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-lg w-100 mt-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
