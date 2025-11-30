<!-- resources/views/project_kinds/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Kinds</h1>
        <a href="{{ route('project_kinds.create') }}" class="btn btn-primary">Create New Project Kind</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kind Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projectKinds as $projectKind)
                    <tr>
                        <td>{{ $projectKind->id }}</td>
                        <td>{{ $projectKind->project_kind_name }}</td>
                        <td>
                            <a href="{{ route('project_kinds.show', $projectKind->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('project_kinds.edit', $projectKind->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('project_kinds.destroy', $projectKind->id) }}" method="POST" style="display:inline;">
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
