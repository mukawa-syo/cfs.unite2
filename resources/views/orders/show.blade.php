<!-- resources/views/orders/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>
        <div class="card">
            <div class="card-header">
                Order Information
            </div>
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ $order->order_id }}</h5>
                <p class="card-text"><strong>Order Date:</strong> {{ $order->order_date }}</p>
                <p class="card-text"><strong>Customer Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $order->email }}</p>
                <p class="card-text"><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
                <p class="card-text"><strong>Postal Code:</strong> {{ $order->postal_code }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $order->address }}</p>
                <p class="card-text"><strong>Building Name:</strong> {{ $order->building_name }}</p>
                <p class="card-text"><strong>Terms Agreed:</strong> {{ $order->terms_agreed ? 'Yes' : 'No' }}</p>
                <p class="card-text"><strong>Payment Completed:</strong> {{ $order->payment_completed ? 'Yes' : 'No' }}</p>
                <p class="card-text"><strong>Charge ID:</strong> {{ $order->charge_id }}</p>
                <p class="card-text"><strong>Session ID:</strong> {{ $order->session_id }}</p>
                <p class="card-text"><strong>Reward Detail ID:</strong> {{ $order->reward_detail_id }}</p>
                <p class="card-text"><strong>Supporter ID:</strong> {{ $order->supporter_id }}</p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
