@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- ヘッダー部分 -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">ホーム</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->category_name }}</li>
            </ol>
        </nav>
        <h1 class="h2 mb-1">{{ $category->category_name }}</h1>
        <p class="text-muted">{{ $category->description ?? 'このカテゴリーのプロジェクト一覧' }}</p>
    </div>

    @if($projects->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <p class="h5 text-muted">このカテゴリーにはまだプロジェクトがありません。</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($projects as $project)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($project->project_image)
                            <img src="{{ asset('storage/' . $project->project_image) }}" 
                                 alt="{{ $project->project_name }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->project_name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($project->description, 100) }}</p>
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ $project->progress_percentage }}%; background: linear-gradient(90deg, #4299e1 0%, #667eea 100%);"
                                     aria-valuenow="{{ $project->progress_percentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <div class="row g-2 text-center mb-3">
                                    <div class="col-6">
                                        <div class="fw-bold">{{ number_format($project->total_pledge_amount) }}円</div>
                                        <small class="text-muted">達成額</small>
                                    </div>
                                    <div class="col-6">
                                        <div class="fw-bold">{{ $project->progress_percentage }}%</div>
                                        <small class="text-muted">達成率</small>
                                    </div>
                                </div>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">
                                    詳細を見る
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <small class="text-muted">
                                残り{{ $project->remaining_days }}日
                                <span class="float-end">
                                    <i class="fas fa-user-friends"></i> {{ $project->total_backers }}人
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 