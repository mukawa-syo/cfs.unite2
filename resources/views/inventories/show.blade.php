<!-- resources/views/inventories/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inventory Details</h1>
        <div class="card">
            <div class="card-header">
                Inventory Information
            </div>
            <div class="card-body">
                <h5 class="card-title">SKU: {{ $inventory->sku }}</h5>
                <p class="card-text"><strong>Stock Quantity:</strong> {{ $inventory->stock_quantity }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $inventory->updated_at }}</p>
                <p class="card-text"><strong>Updated By:</strong> {{ $inventory->updated_by }}</p>
                <a href="{{ route('inventories.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
