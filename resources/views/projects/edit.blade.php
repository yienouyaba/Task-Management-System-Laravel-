@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Edit Project</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Project Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ $project->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea name="description" id="description" class="form-control form-control-lg" rows="4">{{ $project->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label fw-bold">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control form-control-lg" value="{{ $project->due_date }}">
                        </div>
                        <button type="submit" class="btn btn-primary text-white btn-lg w-100">
                            <i class="fas fa-save"></i> Update Project
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
