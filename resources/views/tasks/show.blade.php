@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Task Details</h3>
                </div>
                <div class="card-body p-4">
                    <p class="fs-5"><strong class="text-primary">Title:</strong> {{ $task->title }}</p>
                    <p class="fs-5"><strong>Description:</strong> {{ $task->description }}</p>
                    <p class="fs-5"><strong>Status:</strong> <span class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'pending' ? 'warning' : 'primary') }}">{{ ucfirst($task->status) }}</span></p>
                    <p class="fs-5"><strong>Priority:</strong> <span class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'secondary') }}">{{ ucfirst($task->priority) }}</span></p>
                    <p class="fs-5"><strong>Project:</strong> {{ $task->project->name ?? 'N/A' }}</p>
                    <p class="fs-5"><strong>Due Date:</strong> <span class="text-danger fw-bold">{{ $task->due_date ?? 'Not Set' }}</span></p>
                    <p class="fs-5"><strong>Created At:</strong> {{ $task->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>

            <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-lg w-100 mt-4">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
