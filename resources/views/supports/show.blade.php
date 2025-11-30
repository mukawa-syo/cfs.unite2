<!-- resources/views/supports/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Support Details</h1>
        <div class="card">
            <div class="card-header">
                Support Information
            </div>
            <div class="card-body">
                <h5 class="card-title">Supporter Name: {{ $support->supporter_name }}</h5>
                <p class="card-text"><strong>Project Name:</strong> {{ $support->project_name }}</p>
                <p class="card-text"><strong>Amount:</strong> {{ $support->amount }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $support->date }}</p>
                <a href="{{ route('supports.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
