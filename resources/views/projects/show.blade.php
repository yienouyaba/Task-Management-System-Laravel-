@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Project Details</h3>
                </div>
                <div class="card-body p-4">
                    <p class="fs-5"><strong class="text-primary">Project Name:</strong> {{ $project->name }}</p>
                    <p class="fs-5"><strong>Description:</strong> {{ $project->description }}</p>
                    <p class="fs-5"><strong>Due Date:</strong> <span class="text-danger fw-bold">{{ $project->due_date }}</span></p>
                </div>
            </div>

            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-lg w-100 mt-4">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
