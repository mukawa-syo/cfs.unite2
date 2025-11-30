<!-- resources/views/supports/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Support</h1>
        <form action="{{ route('supports.update', $support->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="supporter_name">Supporter Name</label>
                <input type="text" class="form-control" id="supporter_name" name="supporter_name" value="{{ $support->supporter_name }}" required>
            </div>
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $support->project_name }}" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $support->amount }}" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $support->date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
