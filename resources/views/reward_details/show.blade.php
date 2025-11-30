<!-- resources/views/reward_details/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reward Detail</h1>
        <div class="card">
            <div class="card-header">
                Reward Detail Information
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $rewardDetail->color }} - {{ $rewardDetail->size }}</h5>
                <p class="card-text"><strong>Reward ID:</strong> {{ $rewardDetail->reward_id }}</p>
                <p class="card-text"><strong>Image:</strong> <img src="{{ $rewardDetail->reward_detail_image }}" alt="Reward Detail Image"></p>
                <a href="{{ route('reward_details.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
