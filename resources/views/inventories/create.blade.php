<!-- resources/views/inventories/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Inventory</h1>
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" required>
            </div>
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
            </div>
            <div class="form-group">
                <label for="updated_by">Updated By</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
