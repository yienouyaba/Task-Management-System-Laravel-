@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tasks List</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    <!-- Formulaire de filtrage -->
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="priority" class="form-control">
                    <option value="">All Priorities</option>
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority }}" {{ request('priority') == $priority ? 'selected' : '' }}>{{ ucfirst($priority) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Liste des tâches -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary " style="padding:20px">
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr style="font-size: 15px;">
                        <td>{{ $task->title }}</td>
                        <td>
                            <span>{{ ucfirst($task->status) }}</span>
                        </td>
                        <td>
                            <span>{{ ucfirst($task->priority) }}</span>
                        </td>

                        <td>{{ $task->due_date }}</td>
                        <td class="text-center">
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm" style="width: 100px; height: 35px; font-size: 15px;">Show</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm" style="width: 100px; height: 35px; font-size: 15px;">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="width: 100px; height: 35px; font-size: 15px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
