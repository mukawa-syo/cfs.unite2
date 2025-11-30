<!-- resources/views/inventories/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inventories</h1>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Create New Inventory</a>
        <table class="table">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Stock Quantity</th>
                    <th>Updated At</th>
                    <th>Updated By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->sku }}</td>
                        <td>{{ $inventory->stock_quantity }}</td>
                        <td>{{ $inventory->updated_at }}</td>
                        <td>{{ $inventory->updated_by }}</td>
                        <td>
                            <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
