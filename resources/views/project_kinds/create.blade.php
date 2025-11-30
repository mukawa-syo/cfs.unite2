<!-- resources/views/project_kinds/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Project Kind</h1>
        <form action="{{ route('project_kinds.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="project_kind_name">Kind Name</label>
                <input type="text" class="form-control" id="project_kind_name" name="project_kind_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
