@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Dashboard</h1>
    <div style="margin-bottom: 8rem;"></div>
    <div class="row text-center mt-4">
        <!-- Total Projects -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 23px">Total Projects</h5>
                    <p class="card-text display-4">{{ $totalProjects }}</p>
                </div>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 23px">Total Tasks</h5>
                    <p class="card-text display-4">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Overdue Tasks -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5 class="card-title">Overdue Tasks</h5>
                    <p class="card-text display-4">{{ $overdueTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <p class="card-text display-4">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row mt-4">
        <div class="col-md-3">
            <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg btn-block" style="font-size:21px;">View Projects</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('tasks.index') }}" class="btn btn-info btn-lg btn-block" style="width: 160px; color:white; font-size:21px;">View Tasks</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('overdue.tasks') }}" class="btn btn-danger btn-lg btn-block">Overdue Tasks</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('completed.tasks') }}" class="btn btn-success btn-lg btn-block">Completed Tasks</a>
        </div>
    </div>
</div>
@endsection
