@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Create a New Task</h3>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <!-- Nom de la tâche -->
                        <div class="mb-3">
                            <label for="title" class="fw-bold">Task Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description:</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Statut -->
                        <div class="mb-3">
                            <label for="status" class="fw-bold">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <!-- Priorité -->
                        <div class="mb-3">
                            <label for="priority" class="fw-bold">Priority:</label>
                            <select name="priority" id="priority" class="form-select">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <!-- Projet lié -->
                        <div class="mb-3">
                            <label for="project_id" class="fw-bold">Project:</label>
                            <select name="project_id" id="project_id" class="form-select">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date d'échéance -->
                        <div class="mb-3">
                            <label for="due_date" class="fw-bold">Due Date:</label>
                            <input type="date" name="due_date" id="due_date" class="form-control">
                        </div>

                        <!-- Actions -->
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-plus"></i> Create Task
                        </button>
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
