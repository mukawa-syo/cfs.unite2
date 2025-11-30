<!-- resources/views/supporters/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Supporter</h1>
        <form action="{{ route('supporters.update', $supporter->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="supporter_name">Name</label>
                <input type="text" class="form-control" id="supporter_name" name="supporter_name" value="{{ $supporter->supporter_name }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $supporter->address }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
