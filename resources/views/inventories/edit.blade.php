<!-- resources/views/inventories/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Inventory</h1>
        <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" value="{{ $inventory->sku }}" required>
            </div>
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $inventory->stock_quantity }}" required>
            </div>
            <div class="form-group">
                <label for="updated_by">Updated By</label>
                <input type="text" class="form-control" id="updated_by" name="updated_by" value="{{ $inventory->updated_by }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
