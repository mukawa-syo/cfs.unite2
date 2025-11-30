<!-- resources/views/supporters/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Supporter</h1>
        <form action="{{ route('supporters.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="supporter_name">Name</label>
                <input type="text" class="form-control" id="supporter_name" name="supporter_name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
