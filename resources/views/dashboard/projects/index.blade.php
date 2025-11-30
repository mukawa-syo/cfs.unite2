@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>マイプロジェクト</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">新規プロジェクト作成</a>
    </div>

    @if($projects->isEmpty())
        <div class="alert alert-info">
            まだプロジェクトを作成していません。新しいプロジェクトを始めましょう！
        </div>
    @else
        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->project_name }}</h5>
                            
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $project->progress_percentage }}%"
                                     aria-valuenow="{{ $project->progress_percentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ $project->progress_percentage }}%
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <small class="text-muted">目標金額</small>
                                    <div>{{ number_format($project->target_pledge_amount) }}円</div>
                                </div>
                                <div class="col">
                                    <small class="text-muted">現在の支援額</small>
                                    <div>{{ number_format($project->total_pledge_amount) }}円</div>
                                </div>
                                <div class="col">
                                    <small class="text-muted">支援者数</small>
                                    <div>{{ $project->supporters_count }}人</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">残り日数</small>
                                <div>{{ $project->remaining_days }}日</div>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('dashboard.projects.show', $project) }}" 
                                   class="btn btn-primary">
                                    管理画面
                                </a>
                                <a href="{{ route('projects.show', $project) }}" 
                                   class="btn btn-outline-primary">
                                    公開ページ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 