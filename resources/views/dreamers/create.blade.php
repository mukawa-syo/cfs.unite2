<!-- resources/views/dreamers/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Dreamer</h1>
        <form action="{{ route('dreamers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="contact_first_name">Contact First Name</label>
                <input type="text" class="form-control" id="contact_first_name" name="contact_first_name" required>
            </div>
            <div class="form-group">
                <label for="contact_last_name">Contact Last Name</label>
                <input type="text" class="form-control" id="contact_last_name" name="contact_last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <!-- 他のフィールドも追加 -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
