<!-- resources/views/supporters/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Supporters</h1>
        <a href="{{ route('supporters.create') }}" class="btn btn-primary">Create New Supporter</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supporters as $supporter)
                    <tr>
                        <td>{{ $supporter->id }}</td>
                        <td>{{ $supporter->supporter_name }}</td>
                        <td>{{ $supporter->address }}</td>
                        <td>
                            <a href="{{ route('supporters.show', $supporter->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('supporters.edit', $supporter->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('supporters.destroy', $supporter->id) }}" method="POST" style="display:inline;">
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
