<!-- resources/views/project_categories/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Project Category Details</h1>
        <div class="card">
            <div class="card-header">
                Project Category Information
            </div>
            <div class="card-body">
                <h5 class="card-title">Category Name: {{ $projectCategory->project_category_name }}</h5>
                <a href="{{ route('project_categories.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
