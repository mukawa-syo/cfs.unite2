<!-- resources/views/project_kinds/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project Kind</h1>
        <form action="{{ route('project_kinds.update', $projectKind->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="project_kind_name">Kind Name</label>
                <input type="text" class="form-control" id="project_kind_name" name="project_kind_name" value="{{ $projectKind->project_kind_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
