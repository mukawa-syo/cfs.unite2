@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $category->name }}に属するプロジェクト</h1>
        @if($projects->isEmpty())
            <p>このカテゴリにはプロジェクトがありません。</p>
        @else
            <div class="grid">
                @foreach($projects as $project)
                    <div class="grid-item">
                        <p>{{ $project->project_name }}</p>
                        <p>{{ $project->target_pledge_amount }}円</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
