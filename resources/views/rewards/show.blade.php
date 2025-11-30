<!-- resources/views/rewards/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reward Details</h1>
        <div class="card">
            <div class="card-header">
                Reward Information
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $reward->reward_name }}</h5>
                <p class="card-text"><strong>Price:</strong> {{ $reward->price_incl_tax }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $reward->reward_description }}</p>
                <p class="card-text"><strong>Image:</strong> <img src="{{ $reward->reward_image }}" alt="Reward Image"></p>
                <p class="card-text"><strong>Delivery Schedule:</strong> {{ $reward->delivery_schedule }}</p>
                <p class="card-text"><strong>Project ID:</strong> {{ $reward->project_id }}</p>
                <a href="{{ route('rewards.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
