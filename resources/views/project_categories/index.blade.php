<!-- resources/views/project_categories/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Categories</h1>
        <a href="{{ route('project_categories.create') }}" class="btn btn-primary">Create New Project Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projectCategories as $projectCategory)
                    <tr>
                        <td>{{ $projectCategory->id }}</td>
                        <td>{{ $projectCategory->project_category_name }}</td>
                        <td>
                            <a href="{{ route('project_categories.show', $projectCategory->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('project_categories.edit', $projectCategory->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('project_categories.destroy', $projectCategory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
