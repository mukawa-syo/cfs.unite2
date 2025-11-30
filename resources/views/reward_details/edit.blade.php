<!-- resources/views/reward_details/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Reward Detail</h1>
        <form action="{{ route('reward_details.update', $rewardDetail->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ $rewardDetail->color }}" required>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" class="form-control" id="size" name="size" value="{{ $rewardDetail->size }}" required>
            </div>
            <div class="form-group">
                <label for="reward_detail_image">Image URL</label>
                <input type="text" class="form-control" id="reward_detail_image" name="reward_detail_image" value="{{ $rewardDetail->reward_detail_image }}">
            </div>
            <div class="form-group">
                <label for="reward_id">Reward ID</label>
                <input type="number" class="form-control" id="reward_id" name="reward_id" value="{{ $rewardDetail->reward_id }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
