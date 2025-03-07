@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Projects List</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>



    <div class="card shadow-sm">
        <div class="card-header bg-primary " style="padding:20px">
        </div>
        <div class="card-body"></div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->due_date }}</td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info" style="width: 100px;">Show</a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning" style="width: 100px;">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width: 100px;">Delete</button>
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