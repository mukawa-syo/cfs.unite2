<!-- resources/views/supports/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Supports</h1>
        <a href="{{ route('supports.create') }}" class="btn btn-primary">Create New Support</a>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('checkout') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-primary">支援する（3,000円）</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supporter Name</th>
                    <th>Project Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supports as $support)
                    <tr>
                        <td>{{ $support->id }}</td>
                        <td>{{ $support->supporter_name }}</td>
                        <td>{{ $support->project_name }}</td>
                        <td>{{ $support->amount }}</td>
                        <td>{{ $support->date }}</td>
                        <td>
                            <a href="{{ route('supports.show', $support->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('supports.edit', $support->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('supports.destroy', $support->id) }}" method="POST" style="display:inline;">
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
