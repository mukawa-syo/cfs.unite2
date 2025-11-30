<!-- resources/views/reward_details/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Reward Detail</h1>
        <form action="{{ route('reward_details.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" id="color" name="color" required>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" class="form-control" id="size" name="size" required>
            </div>
            <div class="form-group">
                <label for="reward_detail_image">Image URL</label>
                <input type="text" class="form-control" id="reward_detail_image" name="reward_detail_image">
            </div>
            <div class="form-group">
                <label for="reward_id">Reward ID</label>
                <input type="number" class="form-control" id="reward_id" name="reward_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
