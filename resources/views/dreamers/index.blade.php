<!-- resources/views/dreamers/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dreamers</h1>
        <a href="{{ route('dreamers.create') }}" class="btn btn-primary">Create New Dreamer</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Contact Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dreamers as $dreamer)
                    <tr>
                        <td>{{ $dreamer->id }}</td>
                        <td>{{ $dreamer->company_name }}</td>
                        <td>{{ $dreamer->contact_first_name }} {{ $dreamer->contact_last_name }}</td>
                        <td>{{ $dreamer->email }}</td>
                        <td>
                            <a href="{{ route('dreamers.show', $dreamer->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('dreamers.edit', $dreamer->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('dreamers.destroy', $dreamer->id) }}" method="POST" style="display:inline;">
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
