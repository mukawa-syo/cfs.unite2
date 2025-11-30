<!-- resources/views/project_kinds/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Kind Details</h1>
        <div class="card">
            <div class="card-header">
                Project Kind Information
            </div>
            <div class="card-body">
                <h5 class="card-title">Kind Name: {{ $projectKind->project_kind_name }}</h5>
                <a href="{{ route('project_kinds.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
