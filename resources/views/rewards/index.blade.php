<!-- resources/views/rewards/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rewards</h1>
        <a href="{{ route('rewards.create') }}" class="btn btn-primary">Create New Reward</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reward Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rewards as $reward)
                    <tr>
                        <td>{{ $reward->id }}</td>
                        <td>{{ $reward->reward_name }}</td>
                        <td>{{ $reward->price_incl_tax }}</td>
                        <td>
                            <a href="{{ route('rewards.show', $reward->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('rewards.edit', $reward->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rewards.destroy', $reward->id) }}" method="POST" style="display:inline;">
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
