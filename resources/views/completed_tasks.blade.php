@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Completed Tasks</h1>
    <div style="margin-bottom: 5rem;"></div>
    <div class="row">
        @foreach($tasks as $task)
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">Completed on: {{ $task->due_date }}</p>
                        <p class="card-text">Status: {{ $task->status }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
