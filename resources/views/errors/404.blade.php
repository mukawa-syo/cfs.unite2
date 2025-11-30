@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page mb-5">
                <h1 class="display-1 text-muted">404</h1>
                <h2 class="mb-4">ページが見つかりません</h2>
                <p class="lead text-muted mb-5">
                    申し訳ありません。お探しのページは存在しないか、移動または削除された可能性があります。
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>ホームページへ
                    </a>
                    <button onclick="window.history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>前のページへ戻る
                    </button>
                </div>
            </div>
            <div class="suggestions mt-5">
                <h3 class="h5 mb-4">以下のページもご確認ください：</h3>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('projects.index') }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-project-diagram fa-2x mb-2 text-primary"></i>
                                <h4 class="h6">プロジェクト一覧</h4>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-tachometer-alt fa-2x mb-2 text-primary"></i>
                                <h4 class="h6">ダッシュボード</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .error-page {
        padding: 3rem 0;
    }
    .error-page h1 {
        font-size: 8rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .suggestions .card {
        transition: transform 0.2s;
        width: 160px;
    }
    .suggestions .card:hover {
        transform: translateY(-5px);
    }
    .suggestions .card-body {
        text-align: center;
        padding: 1.5rem;
    }
</style>
@endpush
@endsection 