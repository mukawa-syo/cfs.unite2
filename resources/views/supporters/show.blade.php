<!-- resources/views/supporters/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Supporter Details</h1>
        <div class="card">
            <div class="card-header">
                Supporter Information
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $supporter->supporter_name }}</h5>
                <p class="card-text"><strong>Address:</strong> {{ $supporter->address }}</p>
                <a href="{{ route('supporters.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
