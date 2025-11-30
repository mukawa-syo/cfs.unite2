<!-- resources/views/project_categories/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Project Category</h1>
        <form action="{{ route('project_categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="project_category_name">Category Name</label>
                <input type="text" class="form-control" id="project_category_name" name="project_category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
