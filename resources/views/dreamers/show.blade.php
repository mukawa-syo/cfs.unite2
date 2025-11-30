<!-- resources/views/dreamers/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dreamer Details</h1>
        <div class="card">
            <div class="card-header">
                Dreamer Information
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $dreamer->company_name }}</h5>
                <p class="card-text"><strong>Contact Name:</strong> {{ $dreamer->contact_first_name }} {{ $dreamer->contact_last_name }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $dreamer->email }}</p>
                <!-- 他のフィールドも追加 -->
                <a href="{{ route('dreamers.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
