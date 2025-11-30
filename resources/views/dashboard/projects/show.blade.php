@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1>{{ $project->project_name }}</h1>
        <p class="text-muted">プロジェクト管理画面</p>
    </div>

    <div class="row">
        <!-- プロジェクト概要 -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">プロジェクト概要</h5>
                    
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" 
                             style="width: {{ $project->progress_percentage }}%"
                             aria-valuenow="{{ $project->progress_percentage }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ $project->progress_percentage }}%
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <small class="text-muted">目標金額</small>
                            <div class="h4">{{ number_format($project->target_pledge_amount) }}円</div>
                        </div>
                        <div class="col">
                            <small class="text-muted">現在の支援額</small>
                            <div class="h4">{{ number_format($project->total_pledge_amount) }}円</div>
                        </div>
                        <div class="col">
                            <small class="text-muted">支援者数</small>
                            <div class="h4">{{ $project->supporters_count }}人</div>
                        </div>
                        <div class="col">
                            <small class="text-muted">残り日数</small>
                            <div class="h4">{{ $project->remaining_days }}日</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">
                            プロジェクトを編集
                        </a>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-primary">
                            公開ページを確認
                        </a>
                    </div>
                </div>
            </div>

            <!-- 最近のアップデート -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">最近のアップデート</h5>
                        <a href="{{ route('dashboard.projects.updates.index', $project) }}" class="btn btn-sm btn-outline-primary">
                            すべて見る
                        </a>
                    </div>

                    @if($recentUpdates->isEmpty())
                        <p class="text-muted">まだアップデートはありません。</p>
                    @else
                        <div class="list-group">
                            @foreach($recentUpdates as $update)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $update->title }}</h6>
                                        <small class="text-muted">{{ $update->created_at->format('Y/m/d') }}</small>
                                    </div>
                                    <p class="mb-1">{{ Str::limit($update->content, 100) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUpdateModal">
                            新規アップデートを投稿
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- サイドバー -->
        <div class="col-md-4">
            <!-- 最近の支援者 -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">最近の支援者</h5>
                        <a href="{{ route('dashboard.projects.supporters', $project) }}" class="btn btn-sm btn-outline-primary">
                            すべて見る
                        </a>
                    </div>

                    @if($recentSupporters->isEmpty())
                        <p class="text-muted">まだ支援者はいません。</p>
                    @else
                        <div class="list-group">
                            @foreach($recentSupporters as $supporter)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $supporter->name }}</h6>
                                        <small class="text-muted">{{ number_format($supporter->pivot->amount) }}円</small>
                                    </div>
                                    <small class="text-muted">{{ $supporter->pivot->created_at->format('Y/m/d') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 新規アップデート投稿モーダル -->
<div class="modal fade" id="newUpdateModal" tabindex="-1" aria-labelledby="newUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.projects.updates.store', $project) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="newUpdateModalLabel">新規アップデートを投稿</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">内容</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">投稿する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 