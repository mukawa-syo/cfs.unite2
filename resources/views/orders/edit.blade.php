<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Order</h1>
        <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $order->last_name }}" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $order->first_name }}" required>
            </div>
            <div class="form-group">
                <label for="kana_last_name">Kana Last Name</label>
                <input type="text" class="form-control" id="kana_last_name" name="kana_last_name" value="{{ $order->kana_last_name }}" required>
            </div>
            <div class="form-group">
                <label for="kana_first_name">Kana First Name</label>
                <input type="text" class="form-control" id="kana_first_name" name="kana_first_name" value="{{ $order->kana_first_name }}" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $order->phone_number }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $order->email }}" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $order->postal_code }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $order->address }}" required>
            </div>
            <div class="form-group">
                <label for="building_name">Building Name</label>
                <input type="text" class="form-control" id="building_name" name="building_name" value="{{ $order->building_name }}">
            </div>
            <div class="form-group">
                <label for="terms_agreed">Terms Agreed</label>
                <input type="checkbox" class="form-control" id="terms_agreed" name="terms_agreed" {{ $order->terms_agreed ? 'checked' : '' }} required>
            </div>
            <div class="form-group">
                <label for="payment_completed">Payment Completed</label>
                <input type="checkbox" class="form-control" id="payment_completed" name="payment_completed" {{ $order->payment_completed ? 'checked' : '' }} required>
            </div>
            <div class="form-group">
                <label for="charge_id">Charge ID</label>
                <input type="text" class="form-control" id="charge_id" name="charge_id" value="{{ $order->charge_id }}" required>
            </div>
            <div class="form-group">
                <label for="session_id">Session ID</label>
                <input type="text" class="form-control" id="session_id" name="session_id" value="{{ $order->session_id }}" required>
            </div>
            <div class="form-group">
                <label for="reward_detail_id">Reward Detail ID</label>
                <input type="number" class="form-control" id="reward_detail_id" name="reward_detail_id" value="{{ $order->reward_detail_id }}" required>
            </div>
            <div class="form-group">
                <label for="supporter_id">Supporter ID</label>
                <input type="number" class="form-control" id="supporter_id" name="supporter_id" value="{{ $order->supporter_id }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
