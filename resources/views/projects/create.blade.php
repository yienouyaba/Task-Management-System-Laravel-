@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Add New Project</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Project Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Enter project name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea name="description" id="description" class="form-control form-control-lg" rows="4" placeholder="Enter project description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label fw-bold">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control form-control-lg">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Create Project</button>
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
