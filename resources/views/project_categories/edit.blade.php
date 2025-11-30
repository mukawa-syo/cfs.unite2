<!-- resources/views/project_categories/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project Category</h1>
        <form action="{{ route('project_categories.update', $projectCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="project_category_name">Category Name</label>
                <input type="text" class="form-control" id="project_category_name" name="project_category_name" value="{{ $projectCategory->project_category_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
