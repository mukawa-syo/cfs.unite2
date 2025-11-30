<!-- resources/views/reward_details/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reward Details</h1>
        <a href="{{ route('reward_details.create') }}" class="btn btn-primary">Create New Reward Detail</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Reward ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rewardDetails as $rewardDetail)
                    <tr>
                        <td>{{ $rewardDetail->id }}</td>
                        <td>{{ $rewardDetail->color }}</td>
                        <td>{{ $rewardDetail->size }}</td>
                        <td>{{ $rewardDetail->reward_id }}</td>
                        <td>
                            <a href="{{ route('reward_details.show', $rewardDetail->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('reward_details.edit', $rewardDetail->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('reward_details.destroy', $rewardDetail->id) }}" method="POST" style="display:inline;">
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
