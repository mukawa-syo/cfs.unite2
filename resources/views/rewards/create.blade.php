<!-- resources/views/rewards/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Reward</h1>
        <form action="{{ route('rewards.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="reward_name">Reward Name</label>
                <input type="text" class="form-control" id="reward_name" name="reward_name" required>
            </div>
            <div class="form-group">
                <label for="price_incl_tax">Price</label>
                <input type="number" step="0.01" class="form-control" id="price_incl_tax" name="price_incl_tax" required>
            </div>
            <div class="form-group">
                <label for="reward_description">Description</label>
                <textarea class="form-control" id="reward_description" name="reward_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="reward_image">Image URL</label>
                <input type="text" class="form-control" id="reward_image" name="reward_image">
            </div>
            <div class="form-group">
                <label for="delivery_schedule">Delivery Schedule</label>
                <input type="date" class="form-control" id="delivery_schedule" name="delivery_schedule" required>
            </div>
            <div class="form-group">
                <label for="project_id">Project ID</label>
                <input type="number" class="form-control" id="project_id" name="project_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
